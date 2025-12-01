<h2>New Job Application for: {{ $job->title }}</h2>
<p><strong>Applicant Name:</strong> {{ $application->name }}</p>
<p><strong>Email:</strong> {{ $application->email }}</p>
<p><strong>Phone:</strong> {{ $application->phone }}</p>
@if($application->cover_letter)
    <p><strong>Cover Letter:</strong></p>
    <div style="background:#f8f8f8;padding:10px;border-radius:4px;">{!! nl2br(e($application->cover_letter)) !!}</div>
@endif
<p><strong>CV File:</strong> Đính kèm trong email.</p>
<p><strong>Thời gian ứng tuyển:</strong> {{ $application->created_at->format('d/m/Y H:i') }}</p>
