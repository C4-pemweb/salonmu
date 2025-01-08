<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div 
    class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6" 
    x-data="notificationFilter({{ json_encode($notifications) }})"
>
    <!-- Header -->
    <h2 class="text-xl font-bold mb-4">Notifikasi</h2>

    <!-- Filter Buttons -->
    <div class="flex gap-4 mb-4">
        <button 
            @click="filter = 'all'" 
            :class="filter === 'all' ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-700'" 
            class="px-4 py-2 rounded">
            Semua
        </button>
        <button 
            @click="filter = 'read'" 
            :class="filter === 'read' ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-700'" 
            class="px-4 py-2 rounded">
            Terbaca
        </button>
        <button 
            @click="filter = 'unread'" 
            :class="filter === 'unread' ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-700'" 
            class="px-4 py-2 rounded">
            Belum Terbaca
        </button>
    </div>

    <!-- Notification List -->
    <div class="space-y-4">
        <template x-for="notification in filteredNotifications" :key="notification.id">
            <div class="p-4 border rounded-lg shadow-sm">
                <h3 class="font-medium text-lg" x-text="notification.title"></h3>
                <p class="text-gray-700 text-sm" x-text="notification.message"></p>
                <p class="text-gray-400 text-xs mt-2" x-text="formatDate(notification.created_at)"></p>
                <span 
                    class="text-xs px-2 py-1 rounded-full" 
                    :class="notification.is_read ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700'">
                    <span x-text="notification.is_read ? 'Terbaca' : 'Belum Terbaca'"></span>
                </span>
            </div>
        </template>
    </div>

    <!-- Jika Tidak Ada Notifikasi -->
    <template x-if="filteredNotifications.length === 0">
        <p class="text-gray-500">Tidak ada notifikasi untuk kategori ini.</p>
    </template>
</div>

            
        </div>
    </div>
    <script>
        function notificationFilter(notifications) {
            return {
                notifications: notifications,
                filter: 'all',
                get filteredNotifications() {
                    if (this.filter === 'all') return this.notifications;
                    if (this.filter === 'read') return this.notifications.filter(n => n.is_read);
                    if (this.filter === 'unread') return this.notifications.filter(n => !n.is_read);
                },
                formatDate(date) {
                    const d = new Date(date);
                    return d.toLocaleString('id-ID', {
                        day: '2-digit',
                        month: 'short',
                        year: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit'
                    });
                },
            };
        }
        </script>
</x-app-layout>
