// complejo/java/core/dashboard.js
class Dashboard {
    constructor(config) {
        this.config = config;
        this.modules = {};
        this.currentSection = 'dashboard';
        this.init();
    }

    init() {
        this.setupEventListeners();
        this.loadSection(this.currentSection);
        this.initializeTheme();
    }

    setupEventListeners() {
        document.querySelectorAll('.menu-item').forEach(item => {
            item.addEventListener('click', (e) => {
                e.preventDefault();
                const section = e.currentTarget.dataset.section;
                this.loadSection(section);
            });
        });

        document.getElementById('themeToggle').addEventListener('click', () => this.toggleTheme());
    }

    loadSection(section) {
        this.currentSection = section;
        // Aquí iría la lógica para cargar el contenido de la sección
        console.log(`Cargando sección: ${section}`);
        // Ejemplo: this.fetchSectionContent(section);
    }

    initializeTheme() {
        document.body.dataset.theme = this.config.theme;
    }

    toggleTheme() {
        const currentTheme = document.body.dataset.theme;
        const newTheme = currentTheme === 'light' ? 'dark' : 'light';
        document.body.dataset.theme = newTheme;
        this.config.theme = newTheme;
        localStorage.setItem('dashboardTheme', newTheme);
    }

    initializeModules() {
        this.modules.charts = new ChartsModule();
        this.modules.notifications = new NotificationsModule();
        this.modules.fileManager = new FileManagerModule();
    }

    // Método para manejar errores
    handleError(error) {
        console.error('Error en el dashboard:', error);
        // Aquí puedes implementar una lógica más avanzada de manejo de errores
    }
}