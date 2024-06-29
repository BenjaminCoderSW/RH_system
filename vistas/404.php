<!-- Estilos para la vista 404 -->
<style>
    .error-container {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 100vh;
        text-align: center;
        background-color: #f8f9fa;
        padding: 20px;
    }
    .error-logo {
        width: 100px;
    }
    .error-title {
        font-size: 10rem;
        font-weight: bold;
        color: #343a40;
    }
    .error-message {
        font-size: 1.5rem;
        color: #6c757d;
    }
    .error-button {
        margin-top: 30px;
    }
</style>
    
<div class="error-container">
    <div class="error-content">
        <div class="error-title">404</div>
        <img src="./img/logo.png" alt="Logotipo de la empresa" class="error-logo">
        <div class="error-message">Lo sentimos, la página que buscas no se pudo encontrar.</div>
        <a href="index.php?vista=logout" class="btn btn-danger error-button">Volver al Inicio</a>
    </div>
</div>
