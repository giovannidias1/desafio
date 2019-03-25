<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/r-2.2.2/datatables.min.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css" />
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/main.css" rel="stylesheet" type="text/css" />

    <title>Hello, world!</title>
</head>

<body>
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
        <h5 class="my-0 mr-md-auto font-weight-normal"><span class="logo-1">Neo</span><span class="logo-2">Assist</span></h5>

    </div>
    <div class="row">
        <div class="col-md-2 card">
            <div class='card-body'>
                <div class="col-md-12">
                    <h4>Selecione o perido</h4>

                    <input id="startDate" placeholder="Data inicial" />
                </div>
                <br>
                <div class="col-md-12">
                    <input class="date-range-filter" id="endDate" placeholder="Data Final" />
                </div>
                <br>
                <div class="col-md 12">
                    <h4>Prioridade</h4>
                    <select id="select-filter" class="form-control form-control-md">
                        <option value="" disabled selected>Pesquisar por prioridade.</option>
                        <option value="Todos" disable>Todos</option>
                        <option value="Alta" disable>Alta</option>
                        <option value="Baixa" disable>Baixa</option>
                    </select>
                </div>
            </div>

        </div>


        <div class="col-md-9 card table-body">
            <div class='card-body'>
                <table id="example" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Data Criação</th>
                            <th>Ultima atualização</th>
                            <th>Prioridade</th>
                            <th>Prontos</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require 'ticket.php';
                        foreach ($tickets as $ticket) {
                            $id = $ticket['TicketID'];
                            $name = $ticket['CustomerName'];
                            $email = $ticket['CustomerEmail'];
                            $dateCreate = $ticket['DateCreate'];
                            $dateUpdate = $ticket['DateUpdate'];
                            $priority = $ticket['Priority'];
                            $points = $ticket['Points'];



                            echo "<tr class='gradeA'>";
                            echo "<td>$id</td>";
                            echo "<td>$name</td>";
                            echo "<td>$email</td>";
                            echo "<td>$dateCreate</td>";
                            echo "<td>$dateUpdate</td>";
                            echo "<td>$priority</td>";
                            echo "<td>$points</td>";

                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Data Criação</th>
                            <th>Ultima atualização</th>
                            <th>Prioridade</th>
                        </tr>
                    </tfoot>
                </table>
            </div>




        </div>

    </div>
    <!-- Modal -->
    <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Mensagens</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.1.1.min.js">
        < script src = "https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity = "sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin = "anonymous" >
    </script>
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/r-2.2.2/datatables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>

    <script type="text/javascript" src="assets/js/main.js"></script>




</body>

</html> 