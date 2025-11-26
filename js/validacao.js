// Função para validar nome de usuário
function validarNome(nome) {
    // Nome deve ter pelo menos 2 caracteres e só pode conter letras, números e espaços
    const regexNome = /^[a-zA-ZÀ-ÿ0-9\s]{2,50}$/;
    return regexNome.test(nome);
}

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
    campo.classList.remove('valido', 'invalido');
    campo.classList.add('invalido');
    
    // Cria mensagem de erro
    if (mensagem) {
        const erroElement = document.createElement('span');
        erroElement.id = `erro-${campoId}`;
        erroElement.className = 'erro';
        erroElement.textContent = mensagem;
        
        campo.parentNode.appendChild(erroElement);
    }
}

// Função para limpar erros
function limparErros() {
    // Remove mensagens de erro
    const erros = document.querySelectorAll('.erro');
    erros.forEach(erro => erro.remove());
    
    // Remove classes de erro dos campos
    const campos = document.querySelectorAll('#id_nome, #id_email, #id_cpf');
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
    const nomeInput = document.getElementById('id_nome');
    const cpfInput = document.getElementById('id_cpf');
    const emailInput = document.getElementById('id_email');
    
    // ✅ VALIDAÇÃO EM TEMPO REAL DO NOME
    if (nomeInput) {
        nomeInput.addEventListener('blur', function() {
            if (this.value.trim() !== '') {
                if (validarNome(this.value)) {
                    marcarComoValido('id_nome');
                } else {
                    mostrarErro('id_nome', 'Nome deve ter pelo menos 2 caracteres e só pode conter letras, números e espaços');
                }
            }
        });
    }
    
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
                // Remove erro se ainda não completou o CPF
                const erroExistente = document.getElementById('erro-id_cpf');
                if (erroExistente && this.value.length < 14) {
                    erroExistente.remove();
                }
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
            
            const nome = document.getElementById('id_nome')?.value || '';
            const email = document.getElementById('id_email')?.value || '';
            const cpf = document.getElementById('id_cpf')?.value || '';
            
            let valido = true;
            let primeiroErro = null;
            
            // ✅ VALIDAR NOME (NOVO CAMPO)
            if (!nome.trim()) {
                mostrarErro('id_nome', 'Por favor, preencha o nome de usuário');
                valido = false;
                if (!primeiroErro) primeiroErro = 'id_nome';
            } else if (!validarNome(nome)) {
                mostrarErro('id_nome', 'Nome deve ter pelo menos 2 caracteres e só pode conter letras, números e espaços');
                valido = false;
                if (!primeiroErro) primeiroErro = 'id_nome';
            }
            
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
                alert('Formulário enviado com sucesso!\n\nNome: ' + nome + '\nE-mail: ' + email + '\nCPF: ' + cpf);
                
                // Limpar formulário após envio (opcional)
                form.reset();
                limparErros();
                
                // Limpar também as classes de validação
                const campos = document.querySelectorAll('#id_nome, #id_email, #id_cpf');
                campos.forEach(campo => {
                    campo.classList.remove('valido', 'invalido');
                });
            }
        });
    }
    
    // ✅ VALIDAÇÃO DA CAIXINHA DE PERGUNTAS (SE EXISTIR)
    const btnEnviarDuvida = document.getElementById('btn-enviar-duvida');
    const inputPergunta = document.getElementById('id_pergunta');
    
    if (btnEnviarDuvida && inputPergunta) {
        btnEnviarDuvida.addEventListener('click', function() {
            const pergunta = inputPergunta.value.trim();
            
            if (pergunta === '') {
                alert('⚠️ Por favor, digite sua dúvida antes de enviar.');
                inputPergunta.focus();
                return;
            }
            
            if (pergunta.length < 10) {
                alert('⚠️ Por favor, descreva melhor sua dúvida (mínimo 10 caracteres).');
                inputPergunta.focus();
                return;
            }
            
            // Simular envio da pergunta
            alert('✅ Sua dúvida foi enviada com sucesso!\n\nEm breve entraremos em contato pelo e-mail cadastrado.');
            inputPergunta.value = ''; // Limpar o campo
            
            console.log('📝 Dúvida enviada:', pergunta);
        });
    }
});

console.log("✅ validacao.js carregado com sucesso");