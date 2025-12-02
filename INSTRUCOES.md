# Sistema de Listagem de Imóveis - CROW GLOBAL

## Descrição do Projeto

Sistema completo de listagem e gestão de imóveis em Portugal, com funcionalidades diferenciadas para administradores, desenvolvedores/construtoras e clientes.

## Funcionalidades Implementadas

### 1. Tela de Login Profissional
- Design moderno e responsivo inspirado no RE/MAX Portugal
- Layout split-screen com imagem de fundo (hero-luxury.jpg)
- Formulário limpo e profissional
- Sem emojis, apenas ícones minimalistas

### 2. Sistema de Listagem de Imóveis
- Visualização pública de imóveis (não exclusivos)
- Filtros por cidade, tipo, transação e quartos
- Cards de imóveis com informações detalhadas
- Imóveis exclusivos visíveis apenas para usuários logados
- Navegação direta por cidade através dos cards da home

### 3. Dashboard do Administrador
- Painel com estatísticas do sistema
- Gestão de pedidos de acesso (aprovar/rejeitar)
- Visualização e exclusão de todos os imóveis
- Filtros e busca avançada

### 4. Área do Developer/Construtora
- Listagem dos próprios imóveis
- Adicionar novos imóveis
- Editar imóveis existentes
- Excluir imóveis
- Campo para marcar imóvel como exclusivo
- Campo para WhatsApp de contato

### 5. Visualização de Imóveis
- Página detalhada com galeria de imagens
- Informações completas do imóvel
- Botão de contato via WhatsApp
- Responsivo e profissional

## Estrutura de Usuários

### Administrador (Admin)
- Acesso total ao sistema
- Aprovar/rejeitar pedidos de acesso
- Visualizar e excluir qualquer imóvel
- Gerenciar usuários

### Developer/Construtora
- Adicionar, editar e excluir próprios imóveis
- Marcar imóveis como exclusivos
- Adicionar WhatsApp para contato
- Visualizar estatísticas dos próprios imóveis

### Cliente
- Visualizar imóveis públicos sem login
- Visualizar imóveis exclusivos após login
- Entrar em contato via WhatsApp
- Filtrar e pesquisar imóveis

## Instalação

### Requisitos
- PHP 8.1+
- Composer
- MySQL/MariaDB
- Node.js e NPM

### Passos

1. **Instalar dependências PHP**
```bash
composer install
```

2. **Configurar ambiente**
```bash
cp .env.example .env
php artisan key:generate
```

3. **Configurar banco de dados no .env**
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=crow_global
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha
```

4. **Executar migrations**
```bash
php artisan migrate
```

5. **Criar link de storage**
```bash
php artisan storage:link
```

6. **Instalar dependências frontend**
```bash
npm install
npm run build
```

7. **Criar usuário administrador (opcional)**
```bash
php artisan tinker
```
```php
$user = new App\Models\User();
$user->name = 'Administrador';
$user->email = 'admin@crowglobal.com';
$user->password = bcrypt('senha123');
$user->role = 'admin';
$user->status = 'active';
$user->save();
```

8. **Iniciar servidor**
```bash
php artisan serve
```

Acesse: http://localhost:8000

## Rotas Principais

### Públicas
- `/` - Página inicial
- `/properties` - Listagem de imóveis
- `/properties/{id}` - Detalhes do imóvel
- `/login` - Login
- `/register` - Registro

### Autenticadas
- `/dashboard` - Dashboard (redireciona conforme role)
- `/my-properties` - Meus imóveis (Developer)
- `/properties/create` - Adicionar imóvel (Developer)
- `/properties/{id}/edit` - Editar imóvel (Developer)

### Admin
- `/admin/dashboard` - Painel administrativo
- `/admin/access-requests` - Pedidos de acesso
- `/admin/properties` - Gestão de imóveis

## Filtros por Cidade

Os cards na página inicial levam diretamente para a listagem filtrada:
- Lisboa: `/properties?city=Lisboa`
- Porto: `/properties?city=Porto`
- Coimbra: `/properties?city=Coimbra`
- Braga: `/properties?city=Braga`
- Faro: `/properties?city=Faro`
- Leiria: `/properties?city=Leiria`

## Imóveis Exclusivos

Para marcar um imóvel como exclusivo:
1. Ao criar/editar imóvel
2. Marcar checkbox "Imóvel Exclusivo"
3. Apenas usuários logados poderão visualizar

## Contato via WhatsApp

1. Adicionar número de WhatsApp ao cadastrar imóvel
2. Formato: +351 912 345 678
3. Botão aparece automaticamente na página do imóvel
4. Mensagem pré-preenchida com título do imóvel

## Tecnologias Utilizadas

- **Backend**: Laravel 10
- **Frontend**: Blade Templates, TailwindCSS
- **Database**: MySQL
- **Autenticação**: Laravel Breeze
- **Upload de Imagens**: Laravel Storage

## Estrutura de Banco de Dados

### Tabela: users
- Campos principais: name, email, password, role, status
- Roles: admin, developer, client

### Tabela: properties
- Campos principais: title, description, type, transaction_type, price, city, address
- Campos adicionais: bedrooms, bathrooms, area, year_built, whatsapp
- Flags: is_exclusive, is_featured, status

### Tabela: access_requests
- Gestão de pedidos de acesso ao sistema
- Status: pending, approved, rejected

## Suporte

Para dúvidas ou problemas, entre em contato com o desenvolvedor.

## Licença

Projeto proprietário - CROW GLOBAL
