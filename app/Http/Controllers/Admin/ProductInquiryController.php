<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductInquiry;
use Illuminate\Http\Request;

class ProductInquiryController extends Controller
{
    public function index()
    {
        $inquiries = ProductInquiry::with('product')
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        
        return view('admin.product-inquiries.index', compact('inquiries'));
    }

    public function show(ProductInquiry $inquiry)
    {
        // Mark as processed when viewing
        if (!$inquiry->is_processed) {
            $inquiry->update([
                'is_processed' => true,
                'processed_at' => now()
            ]);
        }

        return view('admin.product-inquiries.show', compact('inquiry'));
    }

    public function markAsRead(ProductInquiry $inquiry)
    {
        $inquiry->update([
            'is_processed' => true,
            'processed_at' => now()
        ]);
        return back()->with('success', __('Inquiry marked as processed.'));
    }

    public function markAsUnread(ProductInquiry $inquiry)
    {
        $inquiry->update([
            'is_processed' => false,
            'processed_at' => null
        ]);
        return back()->with('success', __('Inquiry marked as unprocessed.'));
    }

    public function destroy(ProductInquiry $inquiry)
    {
        $inquiry->delete();

        return redirect()->route('admin.product-inquiries.index')
            ->with('success', __('Inquiry deleted successfully.'));
    }
}
