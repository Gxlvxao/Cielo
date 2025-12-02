# Crow Global Real Estate Platform 🏢

Sistema completo de gestão de imóveis para investimentos imobiliários em Portugal, desenvolvido em Laravel com sistema multi-nível de usuários e área exclusiva off-market.

## 🚀 Funcionalidades Implementadas

### ✅ Front-end Completo
- **Landing Page** premium com design inspirado em RE/MAX Portugal
- **Hero Section** com call-to-action
- **Cards de Municípios** clicáveis (Lisboa, Porto, Coimbra, Braga, Faro, Leiria)
- **Seção About** com estatísticas
- **Seção Services** com diferenciais
- **Formulário de Candidatura** funcional
- **Footer** completo
- **Design 100% responsivo** com Tailwind CSS

### ✅ Sistema de Autenticação Multi-Nível
- **3 níveis de usuário**: Admin, Developer (Construtora), Client
- **Laravel Breeze** como base
- **Controle de acesso** com middlewares customizados
- **Expiração de acesso** configurável por usuário
- **Status de conta** (active, inactive, suspended)

### ✅ Gestão de Imóveis
- **CRUD completo** de imóveis
- **Upload múltiplo de imagens** com preview
- **16 comodidades** selecionáveis
- **Campos detalhados**: localização, características, preços
- **Aprovação por admin** para imóveis de developers
- **Área pública** e **área exclusiva** (off-market)
- **Filtros múltiplos**: cidade, tipo, preço, quartos, área
- **Ordenação** por data, preço e área
- **Galeria de imagens** com navegação por teclado
- **Imóveis relacionados** por cidade

### ✅ Sistema de Candidatura
- **Formulário público** para solicitar acesso
- **4 tipos de investidor**: Client, Developer, Family Office, Institutional
- **Upload de comprovação** de fundos (opcional)
- **Aprovação/rejeição** por admin
- **Geração automática** de senha temporária
- **Controle de prazo** de acesso (7, 30 dias, etc)

### ✅ Painel Administrativo
- **Dashboard** com estatísticas em tempo real
- **Gestão de imóveis**: aprovar, rejeitar, destacar
- **Gestão de usuários**: status, extensão de acesso
- **Gestão de candidaturas**: aprovar/rejeitar com notas
- **Filtros avançados** em todas as listagens
- **Ações rápidas** e interface intuitiva

### ✅ Área do Developer
- **"Meus Imóveis"** com listagem completa
- **Cadastro de imóveis** com formulário rico
- **Edição** dos próprios imóveis
- **Status de aprovação** visível
- **Upload de imagens** com preview

## 📋 Requisitos

- PHP 8.1+
- Composer
- MySQL 8.0+
- Node.js 18+ e npm/pnpm
- Extensões PHP: BCMath, Ctype, Fileinfo, JSON, Mbstring, OpenSSL, PDO, Tokenizer, XML

## 🛠️ Instalação

### 1. Clone o repositório
```bash
git clone https://github.com/Gxlvxao/teste-2-.git
cd teste-2-
```

### 2. Instale as dependências
```bash
composer install
npm install
```

### 3. Configure o ambiente
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Configure o banco de dados no `.env`
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=crow_global
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha
```

### 5. Execute as migrations e seeders
```bash
php artisan migrate --seed
```

### 6. Crie o link simbólico do storage
```bash
php artisan storage:link
```

### 7. Compile os assets
```bash
npm run build
```

### 8. Inicie o servidor
```bash
php artisan serve
```

Acesse: http://localhost:8000

## 👤 Credenciais de Teste

### Admin
- **Email**: admin@crowglobal.com
- **Senha**: password123

### Developer
- **Email**: developer@example.com
- **Senha**: password123

### Client
- **Email**: client@example.com
- **Senha**: password123

## 📁 Estrutura do Projeto

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Admin/
│   │   │   └── AdminController.php
│   │   ├── AccessRequestController.php
│   │   └── PropertyController.php
│   └── Middleware/
│       ├── EnsureUserIsAdmin.php
│       └── EnsureUserHasActiveAccess.php
├── Models/
│   ├── User.php
│   ├── Property.php
│   └── AccessRequest.php
database/
├── migrations/
│   ├── 2025_12_02_012355_add_role_and_status_to_users_table.php
│   ├── 2025_12_02_012510_create_access_requests_table.php
│   └── 2025_12_02_012650_create_properties_table.php
└── seeders/
    ├── AdminUserSeeder.php
    └── PropertySeeder.php
resources/
├── views/
│   ├── admin/
│   │   └── dashboard.blade.php
│   ├── properties/
│   │   ├── index.blade.php (listagem pública)
│   │   ├── exclusive.blade.php (área exclusiva)
│   │   ├── show.blade.php (detalhes)
│   │   ├── create.blade.php (cadastro)
│   │   └── my-properties.blade.php (developer)
│   ├── components/
│   │   ├── header.blade.php
│   │   ├── hero.blade.php
│   │   ├── municipalities.blade.php
│   │   └── ...
│   └── layouts/
│       ├── app.blade.php
│       └── public.blade.php
└── css/
    └── app.css (Tailwind customizado)
```

## 🎨 Design e Estilo

- **Framework CSS**: Tailwind CSS
- **Cores principais**:
  - Bronze: `#CD7F32` (accent)
  - Graphite: `#2C2C2C` (primary)
  - Branco: `#FFFFFF`
- **Tipografia**: Inter (sans-serif)
- **Inspiração**: RE/MAX Portugal

## 🔐 Níveis de Acesso

### Admin
- Acesso total ao sistema
- Aprovar/rejeitar imóveis
- Aprovar/rejeitar candidaturas
- Gerenciar usuários
- Destacar imóveis
- Acesso à área exclusiva

### Developer (Construtora)
- Cadastrar imóveis
- Editar próprios imóveis
- Ver próprios imóveis
- Aguardar aprovação do admin

### Client
- Ver imóveis públicos
- Acessar área exclusiva (se aprovado)
- Entrar em contato

## 📝 Fluxo de Candidatura

1. **Usuário público** preenche formulário de candidatura
2. **Admin recebe notificação** (email - TODO)
3. **Admin avalia** candidatura no painel
4. **Se aprovado**:
   - Conta criada automaticamente
   - Senha temporária gerada
   - Email enviado com credenciais (TODO)
   - Acesso expira após X dias
5. **Se rejeitado**:
   - Email de rejeição enviado (TODO)

## 🚧 Próximas Implementações

### Prioridade Alta
- [ ] Sistema de emails (notificações, aprovações, senhas)
- [ ] Formulário de contato funcional
- [ ] Mapa interativo na view de detalhes
- [ ] Favoritos de imóveis
- [ ] Comparação de imóveis

### Prioridade Média
- [ ] Dashboard do developer com estatísticas
- [ ] Histórico de alterações de imóveis
- [ ] Sistema de mensagens internas
- [ ] Relatórios para admin
- [ ] Exportação de dados (PDF, Excel)

### Prioridade Baixa
- [ ] API REST para mobile
- [ ] Sistema de notificações push
- [ ] Chat em tempo real
- [ ] Integração com CRM
- [ ] Análise de métricas (Google Analytics)

## 🐛 Problemas Conhecidos

- Emails ainda não estão sendo enviados (configuração SMTP necessária)
- Formulário de contato na view de detalhes não está funcional
- Falta validação de coordenadas GPS

## 📄 Licença

Este projeto é proprietário da Crow Global.

## 👥 Contribuidores

- **Desenvolvedor**: Aquiles Augusto
- **Data**: Dezembro 2025

## 📞 Suporte

Para dúvidas ou problemas, entre em contato através do repositório GitHub.

---

**Desenvolvido usando Laravel 10 e Tailwind CSS**
