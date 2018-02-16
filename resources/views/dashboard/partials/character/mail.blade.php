<div class="mt-3">

    <table class="table table-striped" id="mail-table">
        <thead>
        <tr>
            <th scope="col">Sender</th>
            <th scope="col">Subject</th>
            <th scope="col">Date</th>
        </tr>
        </thead>
    </table>

</div>

@include('dashboard.partials.mail.modal')

@push('js')
    <script>
        $(function() {

            var table = $('#mail-table').DataTable({
                processing: true,
                serverSide: true,
                select: {
                    items: 'row'
                },
                autoWidth: false,
                ajax: '{!! route('character.mails', $character) !!}',
                columns: [
                    { data: 'sender_name', name: 'sender_name' },
                    { data: 'subject', name: 'subject' },
                    { data: 'date', name: 'date' }
                ]
            });

            $('#mail-table').on('click', 'tr', function(event) {
                var data = table.row(this).data();

                axios.post('{{route('character.mail', $character)}}', {id: data['mail_id']}).then(function(response) {
                    var data = response.data.data;

                    $('#mail-modal').on('show.bs.modal', function (event) {

                        var modal = $(this);
                        modal.find('#mail-modal-subject').text(data.subject);
                        modal.find('#mail-modal-content').text(data.content);
                        modal.find('#mail-modal-date').text(data.date);
                        modal.find('#mail-modal-sender').text(data.sender_name);
                    });

                    $('#mail-modal').modal({show: true});
                });
            });


        });
    </script>
@endpush