{{-- resources/views/components/admin/view-modal.blade.php --}}
@props(['title' => 'View Details'])

<div
  class="fixed inset-0 z-50 hidden h-full w-full overflow-y-auto bg-black/50 px-2 backdrop-blur-sm"
  id="viewModal">
  <div
    class="relative mx-auto my-10 w-full max-w-4xl rounded-2xl bg-white shadow-2xl dark:bg-gray-800">
    <div class="flex items-center justify-between border-b border-gray-200 p-6 dark:border-gray-700">
      <h3 class="text-xl font-bold text-gray-900 dark:text-white" id="viewModalTitle">
        {{ $title }}</h3>
      <button
        class="text-accent hover:bg-accent hover:text-primary dark:hover:bg-accent dark:hover:text-primary rounded-lg p-1"
        onclick="closeViewModal()">
        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path d="M6 18L18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round"
            stroke-width="2"></path>
        </svg>
      </button>
    </div>
    <div class="overflow-x-auto p-6" id="viewModalContent">
      <div class="flex items-center justify-center py-8">
        <div
          class="h-8 w-8 animate-spin rounded-full border-4 border-blue-500 border-t-transparent">
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  function closeViewModal() {
    document.getElementById('viewModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
  }

  function openViewModal() {
    document.getElementById('viewModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
  }

  function escapeHtml(text) {
    if (!text) return '';
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
  }

  // Generic view handler
  window.viewItem = async function(type, id) {
    openViewModal();
    const content = document.getElementById('viewModalContent');
    const modalTitle = document.getElementById('viewModalTitle');

    // Define configurations for each item type
    const configs = {
      event: {
        title: 'Event Details',
        fetchUrl: (id) => `/admin/events/${id}/edit`,
        extractData: (data) => data.event,
        renderer: (item) => renderEventDetails(item)
      },
      admission: {
        title: 'Admission Details',
        fetchUrl: (id) => `/admin/admissions/${id}/edit`,
        extractData: (data) => data.admission,
        renderer: (item) => renderAdmissionDetails(item)
      },
      blog: {
        title: 'Blog Post Details',
        fetchUrl: (id) => `/admin/blogs/${id}/edit`,
        extractData: (data) => data.blog,
        renderer: (item) => renderBlogDetails(item)
      },
      funding: {
        title: 'Funding Opportunity Details',
        fetchUrl: (id) => `/admin/fundings/${id}/edit`,
        extractData: (data) => data.funding,
        renderer: (item) => renderFundingDetails(item)
      },
      university: {
        title: 'University Details',
        fetchUrl: (id) => `/admin/universities/${id}/edit`,
        extractData: (data) => data.university,
        renderer: (item) => renderUniversityDetails(item)
      },
    //   consultation: {
    //     title: 'Consultation Details',
    //     fetchUrl: (id) => `/admin/consultations/${id}`,
    //     extractData: (data) => data.consultation,
    //     renderer: (item) => renderConsultationDetails(item)
    //   },
    //   newsletter: {
    //     title: 'Newsletter Details',
    //     fetchUrl: (id) => `/admin/newsletters/${id}`,
    //     extractData: (data) => data.newsletter,
    //     renderer: (item) => renderNewsletterDetails(item)
    //   },
    //   admin: {
    //     title: 'Admin Details',
    //     fetchUrl: (id) => `/admin/settings/admins/${id}/edit`,
    //     extractData: (data) => data,
    //     renderer: (item) => renderAdminDetails(item)
    //   }
    };

    const config = configs[type];
    if (!config) {
      content.innerHTML = `
        <div class="text-center py-8">
            <svg class="mx-auto h-12 w-12 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
            </svg>
            <p class="mt-2 text-sm text-red-600 dark:text-red-400">Invalid item type</p>
        </div>
      `;
      return;
    }

    modalTitle.textContent = config.title;

    try {
      const response = await fetch(config.fetchUrl(id));
      const data = await response.json();
      const item = config.extractData(data);

      content.innerHTML = config.renderer(item);
    } catch (error) {
      console.error('View error:', error);
      content.innerHTML = `
            <div class="text-center py-8">
                <svg class="mx-auto h-12 w-12 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                </svg>
                <p class="mt-2 text-sm text-red-600 dark:text-red-400">Error loading details</p>
            </div>
        `;
    }
  };

//   TODO: Fix image issue in controllers

  // Renderer functions for each item type
  function renderEventDetails(event) {
    return `
        <div class="space-y-6">
            ${event.image ? `
                <div class="rounded-lg overflow-hidden">
                    <img src="${event.image}" alt="${escapeHtml(event.title)}" class="w-full h-64 object-cover">
                </div>
            ` : ''}
            <div>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">${escapeHtml(event.title)}</h2>
                ${event.subtitle ? `<p class="mt-1 text-gray-600 dark:text-gray-400">${escapeHtml(event.subtitle)}</p>` : ''}
            </div>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div class="rounded-lg bg-gray-50 p-4 dark:bg-gray-700">
                    <label class="text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">Date & Time</label>
                    <p class="mt-1 text-gray-900 dark:text-white">${event.formatted_date || new Date(event.date).toLocaleDateString()}</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400">${event.formatted_start_time} - ${event.formatted_end_time}</p>
                </div>
                <div class="rounded-lg bg-gray-50 p-4 dark:bg-gray-700">
                    <label class="text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">Location</label>
                    <p class="mt-1 text-gray-900 dark:text-white">${escapeHtml(event.location)}</p>
                </div>
                <div class="rounded-lg bg-gray-50 p-4 dark:bg-gray-700">
                    <label class="text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">Timezone</label>
                    <p class="mt-1 text-gray-900 dark:text-white">${escapeHtml(event.timezone)}</p>
                </div>
                <div class="rounded-lg bg-gray-50 p-4 dark:bg-gray-700">
                    <label class="text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">Status</label>
                    <p class="mt-1">
                        <span class="inline-flex rounded-full px-2.5 py-0.5 text-xs font-semibold ${new Date(event.date) > new Date() ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-gray-100 text-gray-800 dark:bg-gray-600 dark:text-gray-300'}">
                            ${new Date(event.date) > new Date() ? 'Upcoming' : 'Past'}
                        </span>
                    </p>
                </div>
            </div>
            ${event.description ? `
                <div class="rounded-lg bg-gray-50 p-4 dark:bg-gray-700">
                    <label class="text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">Description</label>
                    <p class="mt-1 text-gray-900 dark:text-white whitespace-pre-wrap">${escapeHtml(event.description)}</p>
                </div>
            ` : ''}
        </div>
    `;
  }

  function renderAdmissionDetails(admission) {
    const deadline = new Date(admission.deadline);
    const isActive = deadline >= new Date();

    return `
        <div class="space-y-6">
            ${admission.image ? `
                <div class="rounded-lg overflow-hidden">
                    <img src="${admission.image}" alt="${escapeHtml(admission.title)}" class="w-full h-64 object-cover">
                </div>
            ` : ''}
            <div>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">${escapeHtml(admission.title)}</h2>
                ${admission.subtitle ? `<p class="mt-1 text-gray-600 dark:text-gray-400">${escapeHtml(admission.subtitle)}</p>` : ''}
            </div>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div class="rounded-lg bg-gray-50 p-4 dark:bg-gray-700">
                    <label class="text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">Program</label>
                    <p class="mt-1 text-gray-900 dark:text-white">${escapeHtml(admission.program)}</p>
                </div>
                <div class="rounded-lg bg-gray-50 p-4 dark:bg-gray-700">
                    <label class="text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">Year</label>
                    <p class="mt-1 text-gray-900 dark:text-white">${escapeHtml(admission.year)}</p>
                </div>
                <div class="rounded-lg bg-gray-50 p-4 dark:bg-gray-700">
                    <label class="text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">Country</label>
                    <p class="mt-1 text-gray-900 dark:text-white">${escapeHtml(admission.country)}</p>
                </div>
                <div class="rounded-lg bg-gray-50 p-4 dark:bg-gray-700">
                    <label class="text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">University</label>
                    <p class="mt-1 text-gray-900 dark:text-white">${escapeHtml(admission.university?.name || 'N/A')}</p>
                </div>
                <div class="rounded-lg bg-gray-50 p-4 dark:bg-gray-700">
                    <label class="text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">Deadline</label>
                    <p class="mt-1 text-gray-900 dark:text-white">${deadline.toLocaleDateString()}</p>
                </div>
                <div class="rounded-lg bg-gray-50 p-4 dark:bg-gray-700">
                    <label class="text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">Status</label>
                    <p class="mt-1">
                        <span class="inline-flex rounded-full px-2.5 py-0.5 text-xs font-semibold ${isActive ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200'}">
                            ${isActive ? 'Active' : 'Expired'}
                        </span>
                    </p>
                </div>
            </div>
            ${admission.content ? `
                <div class="rounded-lg bg-gray-50 p-4 dark:bg-gray-700">
                    <label class="text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">Content</label>
                    <p class="mt-1 text-gray-900 dark:text-white whitespace-pre-wrap">${escapeHtml(admission.content)}</p>
                </div>
            ` : ''}
        </div>
    `;
  }

  function renderBlogDetails(blog) {
    return `
        <div class="space-y-6">
            ${blog.featured_image ? `
                <div class="rounded-lg overflow-hidden">
                    <img src="${blog.featured_image_url}" alt="${escapeHtml(blog.title)}" class="w-full h-64 object-cover">
                </div>
            ` : ''}
            <div>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">${escapeHtml(blog.title)}</h2>
                ${blog.subtitle ? `<p class="mt-1 text-gray-600 dark:text-gray-400">${escapeHtml(blog.subtitle)}</p>` : ''}
            </div>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div class="rounded-lg bg-gray-50 p-4 dark:bg-gray-700">
                    <label class="text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">Author</label>
                    <p class="mt-1 text-gray-900 dark:text-white">${escapeHtml(blog.user?.name || 'N/A')}</p>
                </div>
                <div class="rounded-lg bg-gray-50 p-4 dark:bg-gray-700">
                    <label class="text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">Created</label>
                    <p class="mt-1 text-gray-900 dark:text-white">${new Date(blog.created_at).toLocaleDateString()}</p>
                </div>
            </div>
            ${blog.content ? `
                <div class="rounded-lg bg-gray-50 p-4 dark:bg-gray-700">
                    <label class="text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">Content</label>
                    <p class="mt-1 text-gray-900 dark:text-white whitespace-pre-wrap">${escapeHtml(blog.content)}</p>
                </div>
            ` : ''}
        </div>
    `;
  }

  function renderFundingDetails(funding) {
    console.log(funding);
    return `
        <div class="space-y-6">
            ${funding.image_url ? `
                <div class="rounded-lg overflow-hidden">
                    <img src="${funding.image_url}" alt="${escapeHtml(funding.name)}" class="w-full h-64 object-cover">
                </div>
            ` : ''}
            <div>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">${escapeHtml(funding.name)}</h2>
            </div>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div class="rounded-lg bg-gray-50 p-4 dark:bg-gray-700">
                    <label class="text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">University</label>
                    <p class="mt-1 text-gray-900 dark:text-white">${escapeHtml(funding.university?.name || 'N/A')}</p>
                </div>
                <div class="rounded-lg bg-gray-50 p-4 dark:bg-gray-700">
                    <label class="text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">Education Level</label>
                    <p class="mt-1 text-gray-900 dark:text-white">${escapeHtml(funding.education_level)}</p>
                </div>
                <div class="rounded-lg bg-gray-50 p-4 dark:bg-gray-700">
                    <label class="text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">Created</label>
                    <p class="mt-1 text-gray-900 dark:text-white">${new Date(funding.created_at).toLocaleDateString()}</p>
                </div>
            </div>
            ${funding.description ? `
                <div class="rounded-lg bg-gray-50 p-4 dark:bg-gray-700">
                    <label class="text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">Description</label>
                    <p class="mt-1 text-gray-900 dark:text-white whitespace-pre-wrap">${escapeHtml(funding.description)}</p>
                </div>
            ` : ''}
        </div>
    `;
  }

  function renderUniversityDetails(university) {
    console.log(university);
    return `
        <div class="space-y-6">
            <div class="flex items-center space-x-4">
                ${university.logo_url ? `
                    <div class="flex-shrink-0">
                        <img src="${university.logo_url}" alt="${escapeHtml(university.name)}" class="h-20 w-20 object-contain rounded-lg">
                    </div>
                ` : ''}
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">${escapeHtml(university.name)}</h2>
                    ${university.subtitle ? `<p class="mt-1 text-gray-600 dark:text-gray-400">${escapeHtml(university.subtitle)}</p>` : ''}
                </div>
            </div>
            ${university.image_url ? `
                <div class="rounded-lg overflow-hidden">
                    <img src="${university.image_url}" alt="${escapeHtml(university.name)}" class="w-full h-64 object-cover">
                </div>
            ` : ''}
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div class="rounded-lg bg-gray-50 p-4 dark:bg-gray-700">
                    <label class="text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">Country</label>
                    <p class="mt-1 text-gray-900 dark:text-white">${escapeHtml(university.country)}</p>
                </div>
                <div class="rounded-lg bg-gray-50 p-4 dark:bg-gray-700">
                    <label class="text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">City</label>
                    <p class="mt-1 text-gray-900 dark:text-white">${escapeHtml(university.city)}</p>
                </div>
            </div>
            ${university.content ? `
                <div class="rounded-lg bg-gray-50 p-4 dark:bg-gray-700">
                    <label class="text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">Content</label>
                    <p class="mt-1 text-gray-900 dark:text-white whitespace-pre-wrap">${escapeHtml(university.content)}</p>
                </div>
            ` : ''}
        </div>
    `;
  }

  function renderConsultationDetails(consultation) {
    return `
        <div class="space-y-6">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div class="rounded-lg bg-gray-50 p-4 dark:bg-gray-700">
                    <label class="text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">Name</label>
                    <p class="mt-1 text-gray-900 dark:text-white">${escapeHtml(consultation.name)}</p>
                </div>
                <div class="rounded-lg bg-gray-50 p-4 dark:bg-gray-700">
                    <label class="text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">Email</label>
                    <p class="mt-1 text-gray-900 dark:text-white">${escapeHtml(consultation.email)}</p>
                </div>
                <div class="rounded-lg bg-gray-50 p-4 dark:bg-gray-700">
                    <label class="text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">Phone</label>
                    <p class="mt-1 text-gray-900 dark:text-white">${escapeHtml(consultation.phone)}</p>
                </div>
                <div class="rounded-lg bg-gray-50 p-4 dark:bg-gray-700">
                    <label class="text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">Submitted Date</label>
                    <p class="mt-1 text-gray-900 dark:text-white">${new Date(consultation.created_at).toLocaleDateString()}</p>
                </div>
            </div>
            ${consultation.message ? `
                <div class="rounded-lg bg-gray-50 p-4 dark:bg-gray-700">
                    <label class="text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">Message</label>
                    <p class="mt-1 text-gray-900 dark:text-white whitespace-pre-wrap">${escapeHtml(consultation.message)}</p>
                </div>
            ` : ''}
        </div>
    `;
  }

  function renderNewsletterDetails(newsletter) {
    return `
        <div class="space-y-6">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div class="rounded-lg bg-gray-50 p-4 dark:bg-gray-700">
                    <label class="text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">Email</label>
                    <p class="mt-1 text-gray-900 dark:text-white">${escapeHtml(newsletter.email)}</p>
                </div>
                <div class="rounded-lg bg-gray-50 p-4 dark:bg-gray-700">
                    <label class="text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">Subscribed Date</label>
                    <p class="mt-1 text-gray-900 dark:text-white">${new Date(newsletter.created_at).toLocaleDateString()}</p>
                </div>
            </div>
            ${newsletter.preferences ? `
                <div class="rounded-lg bg-gray-50 p-4 dark:bg-gray-700">
                    <label class="text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">Preferences</label>
                    <p class="mt-1 text-gray-900 dark:text-white whitespace-pre-wrap">${escapeHtml(JSON.stringify(newsletter.preferences, null, 2))}</p>
                </div>
            ` : ''}
        </div>
    `;
  }

  function renderAdminDetails(admin) {
    return `
        <div class="space-y-6">
            <div class="flex items-center space-x-4 border-b border-gray-200 pb-4 dark:border-gray-700">
                <div class="flex h-20 w-20 items-center justify-center rounded-full bg-linear-to-r from-blue-500 to-purple-500 text-white">
                    <span class="text-2xl font-bold">${admin.name.charAt(0).toUpperCase()}</span>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">${escapeHtml(admin.name)}</h2>
                    <p class="text-gray-600 dark:text-gray-400">${escapeHtml(admin.email)}</p>
                </div>
            </div>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div class="rounded-lg bg-gray-50 p-4 dark:bg-gray-700">
                    <label class="text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">Role</label>
                    <p class="mt-1 text-lg font-medium text-gray-900 dark:text-white">${admin.role === 'super_admin' ? 'Super Admin' : 'Admin'}</p>
                </div>
                <div class="rounded-lg bg-gray-50 p-4 dark:bg-gray-700">
                    <label class="text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">Status</label>
                    <p class="mt-1">
                        <span class="inline-flex rounded-full px-2.5 py-0.5 text-xs font-semibold ${admin.is_active ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200'}">
                            ${admin.is_active ? 'Active' : 'Inactive'}
                        </span>
                    </p>
                </div>
                <div class="rounded-lg bg-gray-50 p-4 dark:bg-gray-700">
                    <label class="text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">Account Created</label>
                    <p class="mt-1 text-gray-900 dark:text-white">${new Date(admin.created_at).toLocaleDateString()}</p>
                </div>
                <div class="rounded-lg bg-gray-50 p-4 dark:bg-gray-700">
                    <label class="text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">Last Updated</label>
                    <p class="mt-1 text-gray-900 dark:text-white">${new Date(admin.updated_at).toLocaleDateString()}</p>
                </div>
            </div>
        </div>
    `;
  }

  // Close modal when clicking outside
  document.getElementById('viewModal')?.addEventListener('click', function(e) {
    if (e.target === this) closeViewModal();
  });
</script>
