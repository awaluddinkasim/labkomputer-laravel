@if (Auth::guard('admin')->check() || Auth::user()->level == 'asisten')
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script>
        var pusher = new Pusher('02a61b9baa791a2610a5', {
            cluster: 'ap1'
        });

        var channel = pusher.subscribe('account');
        channel.bind('user-registered', function(data) {
            if ($('#unverified').length > 0) {
                $('#unverified').text(data.totalUnverified);
            } else {
                $('.mhs').html('Mahasiswa <span id="unverified" class="badge badge-danger ml-auto">' + data
                    .totalUnverified + '</span>');
                $('.daftar-mhs').html('Daftar Mahasiswa <span id="unverified" class="badge badge-danger ml-auto">' +
                    data.totalUnverified + '</span>');
            }
        });
    </script>
@endif
