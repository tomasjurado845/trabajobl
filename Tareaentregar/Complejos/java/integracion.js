// Archivo: Complejo/java/integracion.js

class DashboardIntegration {
    constructor() {
        this.dashboard = new Dashboard();
        this.setupAjaxHandlers();
        this.setupCustomEvents();
        this.initializeModules();
    }

    setupAjaxHandlers() {
        // Configuración global de Ajax
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            baseUrl: '/complejo/api/'
        });
    }

    setupCustomEvents() {
        // Eventos personalizados para la integración
        document.addEventListener('dashboardLoaded', this.onDashboardLoad.bind(this));
        document.addEventListener('contentUpdated', this.onContentUpdate.bind(this));
    }

    initializeModules() {
        // Inicializar módulos específicos del complejo
        this.initializeUserModule();
        this.initializeContentModule();
        this.initializeSettingsModule();
    }

    initializeUserModule() {
        const userEndpoints = {
            getUsers: 'complejo/usuarios/obtener',
            createUser: 'complejo/usuarios/crear',
            updateUser: 'complejo/usuarios/actualizar',
            deleteUser: 'complejo/usuarios/eliminar'
        };

        // Extender la funcionalidad del dashboard para usuarios
        this.dashboard.userManagement = {
            async getUsers() {
                try {
                    const response = await fetch(userEndpoints.getUsers);
                    return await response.json();
                } catch (error) {
                    console.error('Error al obtener usuarios:', error);
                    return [];
                }
            },

            async createUser(userData) {
                try {
                    const response = await fetch(userEndpoints.createUser, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(userData)
                    });
                    return await response.json();
                } catch (error) {
                    console.error('Error al crear usuario:', error);
                    throw error;
                }
            }
        };
    }

    initializeContentModule() {
        // Configuración específica para el manejo de contenido
        const contentConfig = {
            uploadPath: '/complejo/uploads/',
            maxFileSize: 5242880, // 5MB
            allowedTypes: ['image/jpeg', 'image/png', 'application/pdf']
        };

        this.dashboard.contentManager = {
            async uploadFile(file) {
                if (!contentConfig.allowedTypes.includes(file.type)) {
                    throw new Error('Tipo de archivo no permitido');
                }

                if (file.size > contentConfig.maxFileSize) {
                    throw new Error('Archivo demasiado grande');
                }

                const formData = new FormData();
                formData.append('file', file);

                try {
                    const response = await fetch('/complejo/api/upload', {
                        method: 'POST',
                        body: formData
                    });
                    return await response.json();
                } catch (error) {
                    console.error('Error al subir archivo:', error);
                    throw error;
                }
            }
        };
    }

    initializeSettingsModule() {
        // Configuración específica del complejo
        const complexSettings = {
            theme: localStorage.getItem('complexTheme') || 'light',
            language: localStorage.getItem('complexLang') || 'es',
            notifications: JSON.parse(localStorage.getItem('complexNotifications')) || {}
        };

        this.dashboard.complexSettings = {
            getSettings() {
                return complexSettings;
            },

            updateSettings(newSettings) {
                Object.assign(complexSettings, newSettings);
                this.saveSettings();
            },

            saveSettings() {
                localStorage.setItem('complexTheme', complexSettings.theme);
                localStorage.setItem('complexLang', complexSettings.language);
                localStorage.setItem('complexNotifications', 
                    JSON.stringify(complexSettings.notifications));
            }
        };
    }

    onDashboardLoad(event) {
        // Inicializar componentes específicos después de cargar el dashboard
        this.loadComplexModules();
        this.setupComplexEventListeners();
    }

    loadComplexModules() {
        // Cargar módulos adicionales específicos del complejo
        import('./modules/complex-specific.js')
            .then(module => {
                module.initialize(this.dashboard);
            })
            .catch(error => {
                console.error('Error al cargar módulos del complejo:', error);
            });
    }

    setupComplexEventListeners() {
        // Configurar escuchadores de eventos específicos del complejo
        document.querySelectorAll('[data-complex-action]').forEach(element => {
            element.addEventListener('click', this.handleComplexAction.bind(this));
        });
    }

    handleComplexAction(event) {
        const action = event.target.dataset.complexAction;
        switch (action) {
            case 'openModule':
                this.openComplexModule(event.target.dataset.moduleId);
                break;
            case 'exportData':
                this.exportComplexData();
                break;
            // Agregar más casos según sea necesario
        }
    }
}

// Inicializar la integración cuando el documento esté listo
document.addEventListener('DOMContentLoaded', () => {
    window.dashboardIntegration = new DashboardIntegration();
});