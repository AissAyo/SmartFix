
        $(document).ready(function() {
            let table = $('#usersTable').DataTable();

            $('#searchBar').on('keyup', function() {
                table.search(this.value).draw();
            });

            $('#statusFilter').on('change', function() {
                table.column(4).search(this.value).draw();
            });

            $('#idTypeFilter').on('change', function() {
                table.column(5).search(this.value).draw();
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
            const addUserBtn = document.getElementById('addUserBtn');
        
            addUserBtn.addEventListener('change', function() {
                const selectedOption = this.value;
                
                if (selectedOption === 'verified') {
                    window.location.href = '/path/to/verified-client';
                } else if (selectedOption === 'normal') {
                    window.location.href = '/templates/Admin/AddNormalClient.html.twig';
                }
            });
        });
        
  