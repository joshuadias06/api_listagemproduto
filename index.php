<?php
$host = 'www.thyagoquintas.com.br';
$db   = 'engenharia_16';
$user = 'engenharia_16';
$pass = 'canariodaterra';
$charset = 'utf8mb4';

// Definir cabeçalho para JSON
header('Content-Type: application/json');

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    // Tentar conexão
    $pdo = new PDO($dsn, $user, $pass, $options);

    // Query para buscar todos os produtos ativos
    $sql = "SELECT id_produto, nome_produto, desc_produto, preco_produto, imagem_produto 
            FROM PRODUTO 
            WHERE produto_ativo = 1";

    $stmt = $pdo->query($sql);
    $produtos = $stmt->fetchAll();

    // Retornar os produtos em formato JSON
    echo json_encode(['total' => count($produtos), 'produtos' => $produtos]);

} catch (PDOException $e) {
    // Retornar erro genérico em formato JSON
    echo json_encode(['error' => 'Erro ao buscar os produtos.']);
    // Aqui você pode logar o erro, por exemplo, em um arquivo ou sistema de monitoramento
    error_log('Erro de conexão: ' . $e->getMessage());
    exit;
}
?>
