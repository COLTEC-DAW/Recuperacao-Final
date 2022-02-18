<?php
session_start();
require_once 'library/conexao.php';
require_once 'library/pensamento.php';
 
$pensamentos = $conexaoDAO->getPensamentos($conexao,$_SESSION['usuario']);

// Retira o usuário daqui caso ele acesse sem estar logado
$logged = $_SESSION['logged'] ?? NULL;
if (!$logged){ header('Location: /recuperação_final/index.php'); };

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datatable</title>
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>

    <div class="container">
        
        <div class="row align-items-center">
            <div class="col">
                <h2 class="pb-2">Pensamentos</h2>
            </div>

            <div class="col">
                <p class="fs-3" style="margin-left: 100px"> <?= "Olá {$_SESSION['nome']}" ?> </p>
            </div>
            
            <div class="col">
                <button class="btn btn-outline-dark me-2" style="margin-left: 300px;" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                </svg>
                </button>
            </div>
        
            <div class="col">
                <form action="index.php" method="get">
                    <input type="hidden" name="logout" value="1">
                    <button class="btn btn-outline-dark me-2" type="submit" name="Logout" style="margin-left: 3px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M10 3.5a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 1 1 0v2A1.5 1.5 0 0 1 9.5 14h-8A1.5 1.5 0 0 1 0 12.5v-9A1.5 1.5 0 0 1 1.5 2h8A1.5 1.5 0 0 1 11 3.5v2a.5.5 0 0 1-1 0v-2z"/>
                            <path fill-rule="evenodd" d="M4.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H14.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"/>
                        </svg>
                    </button>
                </form>
            </div>

        <hr>
        </div>
        
            
        

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Adicionar novo pensamento </h5>
                <button type="button" class="btn-close btn-outline-danger" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="library/dados_pensamentos.php" method="POST">

                    <div class="mb-3">
                      <label for="pensamento" class="form-label">Escreva aqui seu pensamento</label>
                      <textarea class="form-control" id="pensamento" rows="3" name="pensamento"></textarea>
                    </div>

                    <label for="categoria" class="form-label">Selecione o tipo</label>
                    <select class="form-select" id="categoria" aria-label="Default select example" name="categoria_id">
                      <option value="1">Diário</option>
                      <option value="2">Anotações</option>
                    </select>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <input type="submit" class="btn btn-outline-success" value="Salvar"></input>
                    </div>
                </form>
            </div>
            </div>
        </div>
        </div>


        <table id="userTable">
            <thead>
                <th>Pensamento</th>
                <th>Criado em</th>
                <th>Tipo</th>
            </thead>
            <tbody>
                <?php if(!empty($pensamentos)) { ?>
                    <?php foreach($pensamentos as $pensamentos) { 
                        ?>
                        <tr>
                            <td><?php echo $pensamentos->get_pensamento(); ?></td>
                            <td><?php echo $pensamentos->get_criado_em(); ?></td>
                            <td><?php echo $pensamentos->get_categoria();  ?></td>
                        </tr>
                    <?php } ?>
                <?php } ?>
            </tbody>
        </table>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script type="text/javascript" src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
        
        <script>
        $(document).ready(function() {
            $('#userTable').DataTable();
        });
        </script>


    </div>




   
</body>
</html>