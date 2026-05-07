<x-admin-layout pageTitle="Settings">
  <div class="mx-auto max-w-7xl">
    <div class="mb-8">
      <h2
        class="from-accent to-accent bg-linear-to-r bg-clip-text text-2xl font-bold text-transparent">
        Settings</h2>
      <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Manage your account and system
        settings</p>
    </div>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
      <!-- Profile Settings -->
      <div class="lg:col-span-2">
        <div class="rounded-2xl bg-white shadow-lg dark:bg-gray-800/50">
          <div class="border-b border-gray-200 p-6 dark:border-gray-700">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Profile Settings</h2>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Update your profile information
            </p>
          </div>

          <div class="p-6">
            <form id="profileForm">
              @csrf
              @method('PUT')
              <div class="space-y-4">
                <div>
                  <label
                    class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                  <input
                    class="focus:border-accent w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                    name="name" type="text" value="{{ $user->name }}">
                </div>
                <div>
                  <label
                    class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                  <input
                    class="focus:border-accent w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                    name="email" type="email" value="{{ $user->email }}">
                </div>
                <div>
                  <label
                    class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Role</label>
                  <input
                    class="w-full rounded-lg border border-gray-300 bg-gray-100 px-4 py-2 dark:border-gray-600 dark:bg-gray-600 dark:text-gray-300"
                    disabled type="text"
                    value="{{ ucfirst(str_replace('_', ' ', $user->role)) }}">
                </div>
                <button
                  class="bg-accent hover:bg-accent/80 rounded-lg px-6 py-2 text-white transition"
                  type="submit">
                  Update Profile
                </button>
              </div>
            </form>
          </div>
        </div>

        <!-- Password Change -->
        <div class="mt-6 rounded-2xl bg-white shadow-lg dark:bg-gray-800/50">
          <div class="border-b border-gray-200 p-6 dark:border-gray-700">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Change Password</h2>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Update your password</p>
          </div>

          <div class="p-6">
            <form id="passwordForm">
              @csrf
              @method('PUT')
              <div class="space-y-4">
                <div>
                  <label
                    class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Current
                    Password</label>
                  <input
                    class="focus:border-accent w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                    name="current_password" required type="password">
                </div>
                <div>
                  <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">New
                    Password</label>
                  <input
                    class="focus:border-accent w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                    name="new_password" required type="password">
                </div>
                <div>
                  <label
                    class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Confirm
                    New Password</label>
                  <input
                    class="focus:border-accent w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                    name="new_password_confirmation" required type="password">
                </div>
                <button
                  class="bg-accent hover:bg-accent/80 rounded-lg px-6 py-2 text-white transition"
                  type="submit">
                  Change Password
                </button>
              </div>
            </form>
          </div>
        </div>

        <div class="mt-6 rounded-2xl bg-white shadow-lg dark:bg-gray-800/50">
          <div class="border-b border-gray-200 p-6 dark:border-gray-700">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Site Settings</h2>
          </div>
          <div class="p-6">
            <form id="siteSettingsForm">
              @csrf
              <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div>
                  <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                  <input
                    class="focus:border-accent w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                    name="email" type="email" value="{{ settings('email') }}">
                </div>
                <div>
                  <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Phone</label>
                  <input
                    class="focus:border-accent w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                    name="phone"
                    type="text" value="{{ settings('phone') }}">
                </div>
                <div class="sm:col-span-2">
                  <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Address</label>
                  <textarea class="focus:border-accent w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none dark:border-gray-600 dark:bg-gray-700 dark:text-white" name="address" rows="2">{{ settings('address') }}</textarea>
                </div>
                <div class="sm:col-span-2">
                  <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Working Hours</label>
                  <textarea class="focus:border-accent w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none dark:border-gray-600 dark:bg-gray-700 dark:text-white" name="working_hours" rows="2">{{ settings('working_hours') }}</textarea>
                </div>
                <div>
                  <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300   ">Instagram URL</label>
                  <input
                    class="focus:border-accent w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                    name="instagram_url" type="url" value="{{ settings('instagram_url') }}">
                </div>
                <div>
                  <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">LinkedIn URL</label>
                  <input class="focus:border-accent w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                    name="linkedin_url" type="url" value="{{ settings('linkedin_url') }}">
                </div>
                <div>
                  <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Facebook URL</label>
                  <input class="focus:border-accent w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                    name="facebook_url" type="url" value="{{ settings('facebook_url') }}">
                </div>
                <div>
                  <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Youtube URL</label>
                  <input class="focus:border-accent w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                    name="youtube_url" type="url" value="{{ settings('youtube_url') }}">
                </div>
                <div class="sm:col-span-2">
                  <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Map URL</label>
                  <textarea class="focus:border-accent w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                    name="map_embed_url" rows="2">{{ settings('map_embed_url') }}</textarea>
                </div>
              </div>
              <button class="bg-accent mt-4 rounded-lg px-6 py-2 text-white" type="submit">Save
                Settings</button>
            </form>
          </div>
        </div>
      </div>

      <!-- Admin Management (Super Admin Only) -->
      <div class="lg:col-span-1">
        <div class="rounded-2xl bg-white shadow-lg dark:bg-gray-800/50">
          <div class="border-b border-gray-200 p-6 dark:border-gray-700">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Admin Management</h2>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Manage system administrators
            </p>
          </div>

          <div class="p-6">
            <button
              class="bg-accent hover:bg-accent/80 mb-4 w-full rounded-lg px-4 py-2 text-white transition hover:cursor-pointer"
              onclick="openCreateAdminModal()">
              Add New Admin
            </button>

            <div class="space-y-3">
              @forelse ($admins as $admin)
                <div class="rounded-lg border border-gray-200 p-4 dark:border-gray-700">
                  <div class="flex items-start justify-between">
                    <div class="flex-1">
                      <h3 class="font-semibold text-gray-900 dark:text-white">{{ $admin->name }}
                      </h3>
                      <p class="text-sm text-gray-600 dark:text-gray-400">{{ $admin->email }}</p>
                      <div class="mt-2 flex items-center gap-2">
                        <span
                          class="{{ $admin->role === 'super_admin' ? 'bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-300' : 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300' }} inline-flex rounded-full px-2 py-1 text-xs font-semibold">
                          {{ ucfirst(str_replace('_', ' ', $admin->role)) }}
                        </span>
                        <span
                          class="{{ $admin->is_active ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300' : 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300' }} inline-flex rounded-full px-2 py-1 text-xs font-semibold">
                          {{ $admin->is_active ? 'Active' : 'Inactive' }}
                        </span>
                      </div>
                    </div>
                    @if ($admin->id !== $user->id)
                      <div class="flex gap-2">
                        <button class="text-blue-600 hover:text-blue-800 dark:text-blue-400"
                          onclick="editAdmin({{ $admin->id }})">
                          <svg class="h-5 w-5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path
                              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                            </path>
                          </svg>
                        </button>
                        <button class="text-red-600 hover:text-red-800 dark:text-red-400"
                          onclick="deleteAdmin({{ $admin->id }}, '{{ $admin->name }}')">
                          <svg class="h-5 w-5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path
                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                            </path>
                          </svg>
                        </button>
                      </div>
                    @endif
                  </div>
                </div>
              @empty
                <div class="py-4 text-center text-gray-500 dark:text-gray-400">
                  No admins found.
                </div>
              @endforelse
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

  <!-- Create/Edit Admin Modal -->
  <div class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 px-2"
    id="adminModal">
    <div class="w-full max-w-md rounded-2xl bg-white p-6 dark:bg-gray-800">
      <h3 class="mb-4 text-xl font-semibold text-gray-900 dark:text-white" id="modalTitle">Add New
        Admin</h3>
      <form id="adminForm">
        @csrf
        <input id="adminId" name="admin_id" type="hidden">
        <div class="space-y-4">
          <div>
            <label
              class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
            <input
              class="focus:border-accent w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none dark:border-gray-600 dark:bg-gray-700 dark:text-white"
              id="adminName" name="name" required type="text">
          </div>
          <div>
            <label
              class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
            <input
              class="focus:border-accent w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none dark:border-gray-600 dark:bg-gray-700 dark:text-white"
              id="adminEmail" name="email" required type="email">
          </div>
          <div id="passwordFields">
            <div>
              <label
                class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Password</label>
              <input
                class="focus:border-accent w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                id="adminPassword" name="password" type="password">
            </div>
            <div>
              <label
                class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Confirm
                Password</label>
              <input
                class="focus:border-accent w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                id="adminPasswordConfirmation" name="password_confirmation" type="password">
            </div>
          </div>
          <div>
            <label
              class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Role</label>
            <select
              class="focus:border-accent w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none dark:border-gray-600 dark:bg-gray-700 dark:text-white"
              id="adminRole" name="role" required>
              <option value="admin">Admin</option>
              <option value="super_admin">Super Admin</option>
            </select>
          </div>
          <div class="hidden" id="statusField">
            <label
              class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
            <select
              class="focus:border-accent w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none dark:border-gray-600 dark:bg-gray-700 dark:text-white"
              id="adminStatus" name="is_active">
              <option value="1">Active</option>
              <option value="0">Inactive</option>
            </select>
          </div>
        </div>
        <div class="mt-6 flex gap-3">
          <button
            class="flex-1 rounded-lg border border-gray-300 px-4 py-2 text-gray-700 transition hover:bg-gray-50 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-700"
            onclick="closeAdminModal()" type="button">
            Cancel
          </button>
          <button
            class="bg-accent hover:bg-accent/80 flex-1 rounded-lg px-4 py-2 text-white transition hover:cursor-pointer"
            type="submit">
            Save
          </button>
        </div>
      </form>
    </div>
  </div>

  <x-slot:scripts>
    <script>
      // Routes configuration (matching the pattern from events page)
      const routes = {
        profile: {
          update: "{{ route('admin.settings.profile.update') }}"
        },
        password: {
          update: "{{ route('admin.settings.password.update') }}"
        },
        admins: {
          store: "{{ route('admin.settings.admins.store') }}",
          edit: (id) => `/admin/settings/admins/${id}/edit`,
          update: (id) => `/admin/settings/admins/${id}`,
          delete: (id) => `/admin/settings/admins/${id}`
        }
      };

      // Profile Update
      document.getElementById('profileForm').addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(e.target);

        try {
          const response = await fetch(routes.profile.update, {
            method: 'PUT',
            headers: {
              'X-CSRF-TOKEN': '{{ csrf_token() }}',
              'Accept': 'application/json',
            },
            body: formData
          });

          const data = await response.json();
          if (data.success) {
            showToast('success', data.message);
          } else {
            showToast('error', data.message || 'Failed to update profile');
          }
        } catch (error) {
          showToast('error', 'Failed to update profile');
        }
      });

      // Password Update
      document.getElementById('passwordForm').addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(e.target);

        try {
          const response = await fetch(routes.password.update, {
            method: 'PUT',
            headers: {
              'X-CSRF-TOKEN': '{{ csrf_token() }}',
              'Accept': 'application/json',
            },
            body: formData
          });

          const data = await response.json();
          if (data.success) {
            showToast('success', data.message);
            e.target.reset();
          } else {
            showToast('error', data.message);
          }
        } catch (error) {
          showToast('error', 'Failed to update password');
        }
      });

      document.getElementById('siteSettingsForm')?.addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(e.target);

        const response = await fetch('{{ route('admin.settings.site.update') }}', {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
          },
          body: formData
        });

        const data = await response.json();
        if (data.success) {
          showToast('success', 'Settings updated!');
          setTimeout(() => location.reload(), 1000);
        }
      });

      // Admin Management Functions
      let currentAdminId = null;

      function openCreateAdminModal() {
        currentAdminId = null;
        document.getElementById('modalTitle').textContent = 'Add New Admin';
        document.getElementById('adminForm').reset();
        document.getElementById('passwordFields').classList.remove('hidden');
        document.getElementById('statusField').classList.add('hidden');
        document.getElementById('adminModal').classList.remove('hidden');
        document.getElementById('adminModal').classList.add('flex');
        document.body.style.overflow = 'hidden';
      }

      function editAdmin(id) {
        currentAdminId = id;
        // Fetch admin details using the route pattern
        fetch(routes.admins.edit(id))
          .then(response => response.json())
          .then(data => {
            document.getElementById('modalTitle').textContent = 'Edit Admin';
            document.getElementById('adminName').value = data.name;
            document.getElementById('adminEmail').value = data.email;
            document.getElementById('adminRole').value = data.role;
            document.getElementById('adminStatus').value = data.is_active ? '1' : '0';
            document.getElementById('passwordFields').classList.add('hidden');
            document.getElementById('statusField').classList.remove('hidden');
            document.getElementById('adminModal').classList.remove('hidden');
            document.getElementById('adminModal').classList.add('flex');
            document.body.style.overflow = 'hidden';
          })
          .catch(error => {
            console.error('Edit error:', error);
            showToast('error', 'Failed to fetch admin details');
          });
      }

      function closeAdminModal() {
        document.getElementById('adminModal').classList.add('hidden');
        document.getElementById('adminModal').classList.remove('flex');
        document.body.style.overflow = 'auto';
      }

      document.getElementById('adminForm').addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(e.target);
        const adminId = currentAdminId;
        const submitButton = e.target.querySelector('button[type="submit"]');
        const originalText = submitButton.innerHTML;

        // Show loading state
        submitButton.innerHTML =
          '<svg class="mx-auto h-5 w-5 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>';
        submitButton.disabled = true;

        let url, method;
        if (adminId) {
          url = routes.admins.update(adminId);
          method = 'PUT';
          formData.append('_method', 'PUT');
        } else {
          url = routes.admins.store;
          method = 'POST';
        }

        try {
          const response = await fetch(url, {
            method: 'POST', // Always POST and use _method for PUT/DELETE
            headers: {
              'X-CSRF-TOKEN': '{{ csrf_token() }}',
              'Accept': 'application/json',
              'X-Requested-With': 'XMLHttpRequest'
            },
            body: formData
          });

          const data = await response.json();
          if (data.success) {
            showToast('success', data.message);
            setTimeout(() => location.reload(), 1500);
          } else {
            showToast('error', data.message || 'Operation failed');
            submitButton.innerHTML = originalText;
            submitButton.disabled = false;
          }
        } catch (error) {
          console.error('Submit error:', error);
          showToast('error', 'Operation failed');
          submitButton.innerHTML = originalText;
          submitButton.disabled = false;
        }
      });

      function deleteAdmin(id, name) {
        if (confirm(`Are you sure you want to delete ${name}?`)) {
          // Show loading state in the confirm dialog doesn't have a button
          const deleteBtn = event.target.closest('button');
          const originalHtml = deleteBtn?.innerHTML;

          fetch(routes.admins.delete(id), {
              method: 'DELETE',
              headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
              }
            })
            .then(response => response.json())
            .then(data => {
              if (data.success) {
                showToast('success', data.message);
                setTimeout(() => location.reload(), 1500);
              } else {
                showToast('error', data.message);
              }
            })
            .catch(error => {
              console.error('Delete error:', error);
              showToast('error', 'Failed to delete admin');
            });
        }
      }

      // Close modal when clicking outside
      document.getElementById('adminModal').addEventListener('click', (e) => {
        if (e.target === document.getElementById('adminModal')) {
          closeAdminModal();
        }
      });

      // Prevent body scroll when modal is open
      function preventBodyScroll() {
        document.body.style.overflow = 'hidden';
      }

      function allowBodyScroll() {
        document.body.style.overflow = 'auto';
      }
    </script>
  </x-slot:scripts>

</x-admin-layout>
