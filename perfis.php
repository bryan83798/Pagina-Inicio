<?php
require_once 'conexao.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Garante que o usuário pai está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$id_usuario = $_SESSION['usuario_id'];
$erro = "";
$sucesso = "";

$action = isset($_GET['action']) ? $_GET['action'] : '';

// 1. AÇÃO: CRIAR NOVO PERFIL
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $action === 'criar') {
    $nome_perfil = trim($_POST['nome_perfil']);
    $avatar_cor = isset($_POST['avatar_cor']) ? $_POST['avatar_cor'] : '#FF7B54';
    $avatar_emoji = isset($_POST['avatar_emoji']) ? $_POST['avatar_emoji'] : '👤';

    if (empty($nome_perfil)) {
        $erro = "O nome do perfil é obrigatório.";
    } else {
        // Limita a 5 perfis ativos (estilo Netflix)
        $stmt_count = $conn->prepare("SELECT COUNT(*) FROM perfis WHERE id_usuario = ? AND status = 'A'");
        $stmt_count->bind_param("i", $id_usuario);
        $stmt_count->execute();
        $stmt_count->bind_result($num_perfis);
        $stmt_count->fetch();
        $stmt_count->close();

        if ($num_perfis >= 5) {
            $erro = "Você atingiu o limite máximo de 5 perfis.";
        } else {
            $stmt_insert = $conn->prepare("INSERT INTO perfis (id_usuario, nome_perfil, avatar_cor, avatar_emoji) VALUES (?, ?, ?, ?)");
            $stmt_insert->bind_param("isss", $id_usuario, $nome_perfil, $avatar_cor, $avatar_emoji);
            if ($stmt_insert->execute()) {
                header("Location: perfis.php");
                exit();
            } else {
                $erro = "Erro ao criar perfil: " . $conn->error;
            }
            $stmt_insert->close();
        }
    }
}

// 2. AÇÃO: SELECIONAR PERFIL
if ($action === 'selecionar' && isset($_GET['id'])) {
    $id_perfil = intval($_GET['id']);
    
    $stmt = $conn->prepare("SELECT nome_perfil, avatar_cor, avatar_emoji FROM perfis WHERE id_perfil = ? AND id_usuario = ? AND status = 'A'");
    $stmt->bind_param("ii", $id_perfil, $id_usuario);
    $stmt->execute();
    $stmt->bind_result($nome_perfil, $avatar_cor, $avatar_emoji);
    
    if ($stmt->fetch()) {
        $_SESSION['perfil_id'] = $id_perfil;
        $_SESSION['perfil_nome'] = $nome_perfil;
        $_SESSION['perfil_cor'] = $avatar_cor;
        $_SESSION['perfil_emoji'] = $avatar_emoji;
        
        header("Location: index.php");
        exit();
    } else {
        $erro = "Perfil inválido ou não encontrado.";
    }
    $stmt->close();
}

// 3. AÇÃO: EXCLUIR PERFIL
if ($action === 'excluir' && isset($_GET['id'])) {
    $id_perfil = intval($_GET['id']);
    
    $stmt = $conn->prepare("UPDATE perfis SET status = 'I' WHERE id_perfil = ? AND id_usuario = ?");
    $stmt->bind_param("ii", $id_perfil, $id_usuario);
    
    if ($stmt->execute()) {
        // Se excluiu o perfil que estava ativo na sessão, limpa a sessão dele
        if (isset($_SESSION['perfil_id']) && $_SESSION['perfil_id'] == $id_perfil) {
            unset($_SESSION['perfil_id']);
            unset($_SESSION['perfil_nome']);
            unset($_SESSION['perfil_cor']);
            unset($_SESSION['perfil_emoji']);
        }
        header("Location: perfis.php");
        exit();
    } else {
        $erro = "Erro ao inativar o perfil.";
    }
    $stmt->close();
}

// Busca todos os perfis ativos
$sql_perfis = "SELECT * FROM perfis WHERE id_usuario = $id_usuario AND status = 'A'";
$resultado_perfis = $conn->query($sql_perfis);

// Modo gerenciamento de perfis (para habilitar o botão de deletar)
$modo_gerenciamento = isset($_GET['manage']) && $_GET['manage'] == '1';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Agadetec - Perfis</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="profiles-body">

    <?php if ($action === 'novo'): ?>
        <!-- TELA DE NOVO PERFIL -->
        <div class="profile-form-container">
            <h2 style="text-align: left; margin-bottom: 5px;">Adicionar Perfil</h2>
            <p style="margin-bottom: 25px;">Insira os dados do perfil abaixo:</p>

            <?php if (!empty($erro)): ?>
                <div class="alert alert-danger"><?php echo htmlspecialchars($erro); ?></div>
            <?php endif; ?>

            <form action="perfis.php?action=criar" method="POST" id="formNovoPerfil">
                <label>Nome do Perfil:</label>
                <input type="text" name="nome_perfil" placeholder="Nome do perfil" required max="20" style="margin-bottom: 20px;">

                <label>Escolha a Cor de Fundo:</label>
                <input type="hidden" name="avatar_cor" id="inputCor" value="#FF7B54">
                <div class="avatar-selection-grid" style="grid-template-columns: repeat(5, 1fr); margin-bottom: 20px;">
                    <div class="avatar-option selected" data-type="cor" data-value="#FF7B54" style="background-color: #FF7B54; height: 40px; border-radius: 4px; cursor: pointer;"></div>
                    <div class="avatar-option" data-type="cor" data-value="#3498db" style="background-color: #3498db; height: 40px; border-radius: 4px; cursor: pointer;"></div>
                    <div class="avatar-option" data-type="cor" data-value="#2ecc71" style="background-color: #2ecc71; height: 40px; border-radius: 4px; cursor: pointer;"></div>
                    <div class="avatar-option" data-type="cor" data-value="#9b59b6" style="background-color: #9b59b6; height: 40px; border-radius: 4px; cursor: pointer;"></div>
                    <div class="avatar-option" data-type="cor" data-value="#f1c40f" style="background-color: #f1c40f; height: 40px; border-radius: 4px; cursor: pointer;"></div>
                </div>

                <label>Escolha um Ícone:</label>
                <input type="hidden" name="avatar_emoji" id="inputEmoji" value="👤">
                <div class="avatar-selection-grid" style="grid-template-columns: repeat(5, 1fr); gap: 10px;">
                    <div class="avatar-option selected" data-type="emoji" data-value="👤">👤</div>
                    <div class="avatar-option" data-type="emoji" data-value="🦊">🦊</div>
                    <div class="avatar-option" data-type="emoji" data-value="🚀">🚀</div>
                    <div class="avatar-option" data-type="emoji" data-value="🐱">🐱</div>
                    <div class="avatar-option" data-type="emoji" data-value="🦖">🦖</div>
                </div>

                <div style="margin-top: 30px; display: flex; gap: 15px;">
                    <button type="submit" style="flex: 1;">Criar Perfil</button>
                    <a href="perfis.php" class="btn-voltar" style="flex: 1; margin: 0; background-color: #444455; line-height: 18px;">Cancelar</a>
                </div>
            </form>
        </div>

        <script>
            // Lógica interativa de seleção de cores e emojis
            document.querySelectorAll('.avatar-option').forEach(item => {
                item.addEventListener('click', function() {
                    const type = this.getAttribute('data-type');
                    const value = this.getAttribute('data-value');
                    
                    // Remove seleção antiga do mesmo grupo
                    document.querySelectorAll(`.avatar-option[data-type="${type}"]`).forEach(opt => {
                        opt.classList.remove('selected');
                    });
                    
                    // Adiciona classe de seleção
                    this.classList.add('selected');
                    
                    // Atualiza input correspondente
                    if(type === 'cor') {
                        document.getElementById('inputCor').value = value;
                    } else if(type === 'emoji') {
                        document.getElementById('inputEmoji').value = value;
                    }
                });
            });
        </script>

    <?php else: ?>
        <!-- TELA DE SELEÇÃO DE PERFIL -->
        <div class="profiles-container">
            <h1>Quem está acessando?</h1>

            <?php if (!empty($erro)): ?>
                <div class="alert alert-danger"><?php echo htmlspecialchars($erro); ?></div>
            <?php endif; ?>

            <div class="profiles-list">
                <?php
                if ($resultado_perfis->num_rows > 0) {
                    while ($perfil = $resultado_perfis->fetch_assoc()) {
                        $sel_url = "perfis.php?action=selecionar&id=" . $perfil['id_perfil'];
                        $del_url = "perfis.php?action=excluir&id=" . $perfil['id_perfil'];
                        ?>
                        <div class="profile-card-wrapper">
                            <?php if ($modo_gerenciamento): ?>
                                <a href="<?php echo $del_url; ?>" class="profile-delete-btn" onclick="return confirm('Deseja realmente excluir o perfil &quot;<?php echo htmlspecialchars($perfil['nome_perfil']); ?>&quot;?');">✕</a>
                            <?php endif; ?>
                            
                            <a href="<?php echo $modo_gerenciamento ? '#' : $sel_url; ?>" class="profile-card">
                                <div class="profile-card-avatar" style="background-color: <?php echo $perfil['avatar_cor']; ?>;">
                                    <?php echo $perfil['avatar_emoji']; ?>
                                </div>
                                <div class="profile-card-name">
                                    <?php echo htmlspecialchars($perfil['nome_perfil']); ?>
                                </div>
                            </a>
                        </div>
                        <?php
                    }
                }
                
                // Exibe botão de adicionar perfil se o número for menor que 5
                if ($resultado_perfis->num_rows < 5) {
                    ?>
                    <div class="profile-card-wrapper">
                        <a href="perfis.php?action=novo" class="profile-card">
                            <div class="profile-card-avatar add-btn">
                                +
                            </div>
                            <div class="profile-card-name">
                                Adicionar Perfil
                            </div>
                        </a>
                    </div>
                    <?php
                }
                ?>
            </div>

            <div>
                <?php if ($modo_gerenciamento): ?>
                    <a href="perfis.php" class="btn-manage-profiles">Concluído</a>
                <?php else: ?>
                    <a href="perfis.php?manage=1" class="btn-manage-profiles">Gerenciar Perfis</a>
                <?php endif; ?>
            </div>
            
            <div style="margin-top: 30px;">
                <a href="logout.php" style="color: #FF4C4C; text-decoration: none; font-weight: bold; font-size: 0.95rem;">Sair da Conta (<?php echo htmlspecialchars($_SESSION['usuario_nome']); ?>)</a>
            </div>
        </div>
    <?php endif; ?>

</body>
</html>
