# Project Management System

A comprehensive, open-source project management system built with Laravel and Filament, designed to provide powerful project tracking and team collaboration tools. This system offers flexible configuration options and enterprise-grade features for teams of all sizes.

## Features

### Core Project Management
- **Projects**: Create and manage multiple projects with customizable settings
- **Tickets**: Full-featured issue tracking with rich descriptions, attachments, and metadata
- **Sprints**: Agile sprint management with start/end dates and capacity planning
- **TicketBoard**: Visual kanban-style board for managing ticket workflow

### Advanced Configuration System
- **TicketTypes & TicketTypeSchemes**: Define custom ticket types (Bug, Feature, Epic, etc.) with project-specific schemes
- **Statuses & StatusSchemes**: Configurable workflow statuses (To Do, In Progress, Done, etc.) with custom schemes per project
- **Priorities & PrioritySchemes**: Flexible priority systems (Critical, High, Medium, Low) with scheme-based configuration

### Collaboration & Communication
- **Comments**: Rich commenting system on tickets with @mentions and notifications
- **File Attachments**: Upload and attach files to tickets using Spatie Media Library
- **User Management**: Role-based access control with project-specific permissions
- **Watchers**: Automatic and manual subscription to ticket updates

### Developer-Friendly Features
- **Multi-language Support**: Built-in internationalization with Laravel's translation system
- **API Documentation**: Auto-generated API documentation with Scribe
- **Modern UI**: Clean, responsive interface built with Filament and TailwindCSS
- **Extensible Architecture**: Plugin-ready architecture for custom extensions

### Upcoming Features
- **Backlog Management**: Advanced backlog prioritization and grooming tools
- **Ticket Links**: Create relationships between tickets (blocks, duplicates, relates to)
- **Advanced Reporting**: Comprehensive analytics and project insights
- **Time Tracking**: Built-in time logging and estimation features

## Tech Stack

- **Backend**: Laravel 12.x (PHP 8.2+)
- **Frontend**: Livewire 3.x with Alpine.js
- **Admin Panel**: Filament 4.x
- **Styling**: TailwindCSS 4.x
- **Database**: SQLite (development) / MySQL/PostgreSQL (production)
- **File Storage**: Spatie Media Library
- **Comments**: Kirschbaum Commentions 0.7.x
- **Testing**: Pest PHP 4.x
- **Code Quality**: Laravel Pint 1.x, PHPStan 3.x
- **API Documentation**: Scribe 5.x

### Filament Plugins

This project leverages several excellent Filament plugins that extend the admin panel functionality:

- **[Filament Shield](https://github.com/bezhanSalleh/filament-shield)** `^4.0` - Advanced role and permission management system
- **[Filament Language Switch](https://github.com/bezhanSalleh/filament-language-switch)** `^4.0` - Multi-language support with easy language switching
- **[Filament Spatie Media Library](https://github.com/filamentphp/spatie-laravel-media-library-plugin)** `^4.0` - File upload and media management integration
- **[Filament Icon Picker](https://github.com/guava/filament-icon-picker)** `^3.0` - Beautiful icon selection component
- **[FlowForge](https://github.com/relaticle/flowforge)** `^2.0` - Advanced workflow and process management

## Requirements

- PHP 8.2 or higher
- Composer
- Node.js 18+ and NPM
- SQLite/MySQL/PostgreSQL database

## Quick Start

### Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/your-username/project-management.git
   cd project-management
   ```

2. **Setup environment**
   ```bash
   # Option 1: Quick setup with Makefile
   make init
   
   # Option 2: Manual setup with Sail commands
   cp .env.example .env  # if .env doesn't exist
   composer install --ignore-platform-reqs
   ./vendor/bin/sail up -d --build
   ./vendor/bin/sail composer install
   ./vendor/bin/sail npm install && ./vendor/bin/sail npm run build
   ./vendor/bin/sail artisan key:generate
   ./vendor/bin/sail artisan storage:link
   ./vendor/bin/sail artisan migrate:fresh
   ./vendor/bin/sail artisan app:setup
   ./vendor/bin/sail artisan shield:super-admin --panel=admin
   ./vendor/bin/sail artisan db:seed --class=ProductionSeeder
   ```

3. **Update domain (optional)**
   Add to `/etc/hosts` for custom domain:
   ```bash
   echo "127.0.0.1 pisa.localhost" | sudo tee -a /etc/hosts
   ```
   Then update `APP_URL=http://pisa.localhost` in `.env`

4. **Access the application**
   - Application: http://pisa.localhost (or http://localhost)
   - Admin Panel: http://pisa.localhost/admin

### Development Commands

Use Laravel Sail for all development tasks:

```bash
# Start services
./vendor/bin/sail up -d
# or
make up

# Stop services  
./vendor/bin/sail down
# or
make down

# Run migrations
./vendor/bin/sail artisan migrate
# or
make migrate

# Run tests
./vendor/bin/sail artisan test
# or
make test

# Install dependencies
./vendor/bin/sail composer install
./vendor/bin/sail npm install
# or
make npm-install

# Code quality
./vendor/bin/sail pint          # Code formatting
./vendor/bin/phpstan analyze    # Static analysis
# or
make pint

# Frontend development
./vendor/bin/sail npm run dev   # Development build
./vendor/bin/sail npm run watch # Watch mode
./vendor/bin/sail npm run build # Production build
# or
make npm-dev
make npm-watch  
make npm-build

# Clear caches
./vendor/bin/sail artisan optimize:clear
# or
make cache-clear
```

**Available Makefile commands:**
- `make init` - Complete project setup
- `make up/down/restart` - Docker services
- `make migrate/migrate-fresh/seed` - Database operations
- `make test/pint` - Testing and code quality
- `make npm-install/npm-dev/npm-build` - Frontend tasks
- `make cache-clear` - Clear all caches

## Usage

### Creating Your First Project

1. Access the admin panel at `/admin`
2. Navigate to **Projects** and click **New Project**
3. Configure your project with:
   - Name and description
   - Ticket prefix (e.g., "PROJ" for tickets like PROJ-1, PROJ-2)
   - Ticket Type Scheme
   - Priority Scheme  
   - Status Scheme

### Setting Up Schemes

**Schemes** allow you to customize ticket types, priorities, and statuses per project:

- **TicketTypeScheme**: Define what types of tickets your project uses (Bug, Feature, Epic, Task)
- **PriorityScheme**: Set priority levels (Critical, High, Medium, Low, or custom levels)
- **StatusScheme**: Configure workflow statuses (To Do, In Progress, Code Review, Done)

### Managing Tickets

- Create tickets with rich descriptions, attachments, and metadata
- Assign tickets to team members
- Set priorities, types, and statuses
- Add comments and @ mention team members
- Organize tickets in sprints
- Track progress on the TicketBoard

### Sprint Management

- Create sprints with start and end dates
- Assign tickets to sprints for better organization
- Track sprint progress and capacity
- View sprint burndown and velocity metrics

## Configuration

### Environment Variables

Key environment variables in `.env`:

```env
APP_NAME="Project Management"
APP_URL=http://localhost:8000

DB_CONNECTION=sqlite
DB_DATABASE=/path/to/database/database.sqlite

MAIL_MAILER=smtp
# Configure for notifications
```

### Customization

The system is highly customizable:

- **Schemes**: Create custom ticket types, priorities, and statuses
- **Permissions**: Configure role-based access control
- **Themes**: Customize the Filament interface
- **Localization**: Add translations for multiple languages

## Testing

Run the test suite:

```bash
./vendor/bin/sail artisan test
# or
make test
```

## API Documentation

API documentation is automatically generated and available at `/docs` when running in development mode.

## Contributing

We welcome contributions! Please see our [Contributing Guidelines](CONTRIBUTING.md) for details.

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## License

This project is open-sourced software licensed under the [MIT license](LICENSE).

## Acknowledgments

- [Laravel](https://laravel.com) - The PHP framework for web artisans
- [Filament](https://filamentphp.com) - Beautiful admin panels for Laravel
- [Livewire](https://livewire.laravel.com) - Full-stack framework for Laravel
- [TailwindCSS](https://tailwindcss.com) - Utility-first CSS framework
- [Spatie](https://spatie.be) - For their excellent Laravel packages

## Support

- **Documentation**: [Link to documentation]
- **Issues**: [GitHub Issues](https://github.com/your-username/project-management/issues)
- **Discussions**: [GitHub Discussions](https://github.com/your-username/project-management/discussions)

---

**Happy Project Managing!**
