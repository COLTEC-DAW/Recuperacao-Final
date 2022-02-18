<?php
/*Retorna true em caso de variavel nula*/
function campoVazioSignup($nome, $usuario, $senha, $confirmaSenha) {
    $result;
    if (empty($nome) || empty($usuario) || empty($senha) || empty($confirmaSenha)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

/*Variavel da função anterior para login*/
function campoVazioLogin($username, $senha){
    $result;
    if (empty($username) || empty($senha)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

/*Retorna true caso nome não apresente caracteres especiais*/
function nomeInvalido($nome) {
    $result;
    if (!preg_match("/^[a-zA-Z0-9\\s]*$/", $nome)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

/*Retorna true caso ambas as variaveis sejam iguais*/
function confereSenhas($senha, $confirmaSenha) {
    $result;
    if ($senha !== $confirmaSenha) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

/*Compara os dados do banco de dados sql e o login do usuario. caso o login seja identio a um dentro do banco de dados,
  o resultado são os dados da row. Caso não encotra nenhum login identico o resultado é falso*/
function usuarioExiste($conn, $usuario) {
    $sql = "SELECT * FROM usuarios WHERE login = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtFail");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $usuario);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    } else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

/*Variante da função anterior para categorias*/
function categoriaExiste($conn, $categoria) {
    $sql = "SELECT * FROM categorias WHERE nome = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../escrever.php?error=stmt3Fail");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $categoria);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        mysqli_stmt_close($stmt);
        return $row;
    } else {
        $result = false;
        mysqli_stmt_close($stmt);
        return $result;
    }
}

/*Função que seleciona parte da database de pensamentos de acordo com o id do usuario da sessão atual*/
function selecionaDiario($conn) {
    $sql = "SELECT p.pensamento, p.criado_em, c.nome AS categorias_id, u.nome AS usuarios_id
            FROM pensamentos p
            JOIN categorias c ON p.categorias_id = c.id
            JOIN usuarios u ON p.usuarios_id = u.id
            WHERE u.id LIKE ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../index.php?error=stmtFail");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "i", $_SESSION["idUsuario"]);
    mysqli_stmt_execute($stmt);

    $table = mysqli_stmt_get_result($stmt);
    return $table;
    
    mysqli_stmt_close($stmt);
}

/*Função usada para o login do usuario. Funciona por comparar os dados colocados pelo usuario e comparando-os com os
  dados da database usando da função usuarioExiste()*/
function loginUsuario($conn, $username, $senha){
    $usuarioExiste = usuarioExiste($conn, $username);

    if ($usuarioExiste == false) {
        header("location: ../login.php?error=usuarioIncorreto");
        exit();
    }

    if (!($senha == $usuarioExiste["senha"])) {
        header("location: ../login.php?error=senhaIncorreta");
        exit();
    }
    else if ($senha == $usuarioExiste["senha"]) {
        session_start();
        $_SESSION["idUsuario"] = $usuarioExiste["id"];
        $_SESSION["loginUsuario"] = $usuarioExiste["login"];
        header("location: ../index.php");
        exit();
    }
}

/*Cria usuario na database a partir de dados inseridos pelo usuario*/
function criarUsuario($conn, $nome, $usuario, $senha) {
    $sql = "INSERT INTO usuarios (nome, login, senha) VALUES (?,?,?)";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtFail");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sss", $nome, $usuario, $senha);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../signup.php?error=nulo");
    exit();
}

/*Variação da função anterior para categorias*/
function criarCategoria($conn, $nome) {
    $sql = "INSERT INTO categorias (nome) VALUES (?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../escrever.php?error=stmt2Fail");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $nome);
    mysqli_stmt_execute($stmt);
    
    mysqli_stmt_close($stmt);
}

/*Variação da função anterior para pensamentos. Utiliza do id da seção atual*/
function criarPensamento($conn, $novoTexto, $categoria) {
    $categoriaExiste = (categoriaExiste($conn, $categoria));
    
    $sql = "INSERT INTO pensamentos(pensamento, criado_em, categorias_id, usuarios_id) VALUES (?, NOW(), ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../escrever.php?error=stmt1Fail");
        exit();
    }

    if ($categoriaExiste == false) {
        criarCategoria($conn, $categoria);
        $categoriaExiste = (categoriaExiste($conn, $categoria));
    }

    session_start();
    mysqli_stmt_bind_param($stmt, "sii", $novoTexto, $categoriaExiste["id"], $_SESSION["idUsuario"]);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../escrever.php?error=nulo");
    exit();
}
?>