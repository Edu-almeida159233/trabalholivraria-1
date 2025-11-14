// Função para validar email
function validarEmail(email) {
    const regexEmail = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    return regexEmail.test(email);
}

// Função para validar CPF
function validarCPF(cpf) {
    const regexCPF = /^\d{3}\.\d{3}\.\d{3}-\d{2}$/;
    return regexCPF.test(cpf);
}

// Função para formatar CPF automaticamente enquanto digita
function formatarCPF(input) {
    let valor = input.value.replace(/\D/g, ''); // Remove tudo que não é dígito
    
    if (valor.length <= 11) {
        valor = valor.replace(/(\d{3})(\d)/, '$1.$2');
        valor = valor.replace(/(\d{3})(\d)/, '$1.$2');
        valor = valor.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
        input.value = valor;
    }
}

// Função para mostrar erros específicos nos campos
function mostrarErro(campoId, mensagem) {
    const campo = document.getElementById(campoId);
    const erroExistente = document.getElementById(`erro-${campoId}`);
    
    // Remove erro anterior
    if (erroExistente) {
        erroExistente.remove();
    }
    
    // Adiciona classe de erro ao campo
    campo.classList.remove('invalido');
    campo.classList.add('invalido');
    
    // Cria mensagem de erro
    if (mensagem) {
        const erroElement = document.createElement('span');
        erroElement.id = `erro-${campoId}`;
        erroElement.className = 'erro';
        erroElement.textContent = mensagem;
        erroElement.style.cssText = 'color: red; font-size: 14px; display: block; margin-top: 5px;';
        
        campo.parentNode.appendChild(erroElement);
    }
}

// Função para limpar erros
function limparErros() {
    // Remove mensagens de erro
    const erros = document.querySelectorAll('.erro');
    erros.forEach(erro => erro.remove());
    
    // Remove classes de erro dos campos
    const campos = document.querySelectorAll('#id_email, #id_cpf');
    campos.forEach(campo => {
        campo.classList.remove('valido', 'invalido');
    });
}

// Função para marcar campo como válido
function marcarComoValido(campoId) {
    const campo = document.getElementById(campoId);
    campo.classList.remove('invalido');
    campo.classList.add('valido');
    
    const erroExistente = document.getElementById(`erro-${campoId}`);
    if (erroExistente) {
        erroExistente.remove();
    }
}

// Adicionar eventos quando o DOM estiver carregado
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const cpfInput = document.getElementById('id_cpf');
    const emailInput = document.getElementById('id_email');
    
    // Adicionar formatação automática ao CPF
    if (cpfInput) {
        cpfInput.addEventListener('input', function() {
            formatarCPF(this);
            
            // Validação em tempo real do CPF
            if (this.value.length === 14) {
                if (validarCPF(this.value)) {
                    marcarComoValido('id_cpf');
                } else {
                    mostrarErro('id_cpf', 'CPF inválido');
                }
            } else {
                limparErros();
            }
        });
    }
    
    // Validação em tempo real do email
    if (emailInput) {
        emailInput.addEventListener('blur', function() {
            if (this.value.trim() !== '') {
                if (validarEmail(this.value)) {
                    marcarComoValido('id_email');
                } else {
                    mostrarErro('id_email', 'E-mail inválido');
                }
            }
        });
    }
    
    // Validação no submit do formulário
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            limparErros();
            
            const email = document.getElementById('id_email').value;
            const cpf = document.getElementById('id_cpf').value;
            
            let valido = true;
            let primeiroErro = null;
            
            // Validar email
            if (!email.trim()) {
                mostrarErro('id_email', 'Por favor, preencha o e-mail');
                valido = false;
                if (!primeiroErro) primeiroErro = 'id_email';
            } else if (!validarEmail(email)) {
                mostrarErro('id_email', 'Por favor, insira um e-mail válido');
                valido = false;
                if (!primeiroErro) primeiroErro = 'id_email';
            }
            
            // Validar CPF
            if (!cpf.trim()) {
                mostrarErro('id_cpf', 'Por favor, preencha o CPF');
                valido = false;
                if (!primeiroErro) primeiroErro = 'id_cpf';
            } else if (!validarCPF(cpf)) {
                mostrarErro('id_cpf', 'Por favor, insira um CPF válido (formato: 000.000.000-00)');
                valido = false;
                if (!primeiroErro) primeiroErro = 'id_cpf';
            }
            
            // Focar no primeiro campo com erro ou enviar formulário
            if (!valido) {
                if (primeiroErro) {
                    document.getElementById(primeiroErro).focus();
                }
                // Rolagem suave para o primeiro erro
                window.scrollTo({
                    top: document.getElementById(primeiroErro).offsetTop - 100,
                    behavior: 'smooth'
                });
            } else {
                // Formulário válido - pode enviar
                alert('Formulário enviado com sucesso!\n\nE-mail: ' + email + '\nCPF: ' + cpf);
                // Aqui você pode adicionar: form.submit(); para enviar realmente
                
                // Limpar formulário após envio (opcional)
                form.reset();
                limparErros();
            }
        });
    }
});