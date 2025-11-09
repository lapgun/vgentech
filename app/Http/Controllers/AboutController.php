<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        // Get "About Us" page content
        $aboutPage = Page::where('slug', 'gioi-thieu')
            ->active()
            ->first();

        // If not found, use multilingual content
        if (!$aboutPage) {
            $aboutPage = $this->getDefaultAboutContent();
        }

        // Get testimonials for about page
        $testimonials = Testimonial::active()
            ->orderBy('sort_order')
            ->get();

        return view('about', compact('aboutPage', 'testimonials'));
    }

    private function getDefaultAboutContent()
    {
        $content = '
            <div class="about-content">
                <h3 class="text-gradient mb-4">' . __('common.about_company_name') . '</h3>
                
                <p class="lead">
                    <strong>' . __('common.company_name') . '</strong> ' . __('common.about_intro_text') . ' <strong>15 ' . __('common.about_intro_years') . '</strong>. 
                    ' . __('common.about_intro_motto') . ' 
                    <em>"' . __('common.about_motto_text') . '"</em>.
                </p>

                <div class="alert alert-info border-0 shadow-sm my-4">
                    <h5 class="mb-3"><i class="fas fa-bullseye text-primary"></i> ' . __('common.about_activity_title') . '</h5>
                    <p class="mb-0">
                        ' . __('common.about_activity_text') . '
                    </p>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> CUMMINS</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> MITSUBISHI</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> PERKINS</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> JOHN DEERE</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> YUCHAI</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> WEICHAI</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> VOLVO PENTA</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> DOOSAN</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> DEUTZ</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> DENYO</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> FPT (IVECO)</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> KOHLER</li>
                        </ul>
                    </div>
                </div>

                <h4 class="text-primary mb-3 mt-5"><i class="fas fa-star"></i> ' . __('common.core_values') . '</h4>
                <div class="row g-4 mb-5">
                    <div class="col-md-4">
                        <div class="text-center p-4 bg-light rounded">
                            <div class="mb-3">
                                <i class="fas fa-shield-alt fa-3x text-primary"></i>
                            </div>
                            <h5 class="fw-bold">' . __('common.core_value_trust') . '</h5>
                            <p class="mb-0">' . __('common.core_value_trust_desc') . '</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-center p-4 bg-light rounded">
                            <div class="mb-3">
                                <i class="fas fa-award fa-3x text-primary"></i>
                            </div>
                            <h5 class="fw-bold">' . __('common.core_value_quality') . '</h5>
                            <p class="mb-0">' . __('common.core_value_quality_desc') . '</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-center p-4 bg-light rounded">
                            <div class="mb-3">
                                <i class="fas fa-handshake fa-3x text-primary"></i>
                            </div>
                            <h5 class="fw-bold">' . __('common.core_value_dedication') . '</h5>
                            <p class="mb-0">' . __('common.core_value_dedication_desc') . '</p>
                        </div>
                    </div>
                </div>

                <h4 class="text-primary mb-3"><i class="fas fa-cogs"></i> ' . __('common.our_services') . '</h4>
                <div class="row g-3 mb-5">
                    <div class="col-md-6">
                        <div class="d-flex align-items-start">
                            <div class="flex-shrink-0">
                                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" 
                                     style="width: 50px; height: 50px;">
                                    <i class="fas fa-truck"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5>' . __('common.service_import') . '</h5>
                                <p class="text-muted mb-0">' . __('common.service_import_desc') . '</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-start">
                            <div class="flex-shrink-0">
                                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" 
                                     style="width: 50px; height: 50px;">
                                    <i class="fas fa-tools"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5>' . __('common.service_maintenance') . '</h5>
                                <p class="text-muted mb-0">' . __('common.service_maintenance_desc') . '</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-start">
                            <div class="flex-shrink-0">
                                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" 
                                     style="width: 50px; height: 50px;">
                                    <i class="fas fa-wrench"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5>' . __('common.service_repair') . '</h5>
                                <p class="text-muted mb-0">' . __('common.service_repair_desc') . '</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-start">
                            <div class="flex-shrink-0">
                                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" 
                                     style="width: 50px; height: 50px;">
                                    <i class="fas fa-headset"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5>' . __('common.service_consulting') . '</h5>
                                <p class="text-muted mb-0">' . __('common.service_consulting_desc') . '</p>
                            </div>
                        </div>
                    </div>
                </div>

                <h4 class="text-primary mb-3"><i class="fas fa-users"></i> ' . __('common.professional_team') . '</h4>
                <p>
                    ' . __('common.professional_team_desc') . ' <strong>50+ ' . __('common.professional_team_count') . '</strong>, 
                    ' . __('common.professional_team_commitment') . '
                </p>

                <h4 class="text-primary mb-3 mt-4"><i class="fas fa-map-marked-alt"></i> ' . __('common.operation_scope') . '</h4>
                <p>
                    ' . __('common.operation_scope_desc') . '
                </p>

                <div class="alert alert-success border-0 shadow-sm mt-5">
                    <h5 class="mb-2"><i class="fas fa-phone-alt"></i> ' . __('common.contact_us_title') . '</h5>
                    <p class="mb-0">
                        ' . __('common.contact_us_desc') . ' 
                        <strong>' . __('common.hotline') . ': 0123-456-789</strong> ' . __('common.or') . ' 
                        <a href="mailto:info@vgentech.com" class="text-success fw-bold">info@vgentech.com</a>
                    </p>
                </div>
            </div>
        ';

        return (object) [
            'title' => __('common.about_title'),
            'content' => $content,
        ];
    }
}
