// complejo/java/modules/notifications.js
class NotificationsModule {
    constructor() {
        this.container = document.createElement('div');
        this.container.className = 'notifications-container';
        document.body.appendChild(this.container);
    }

    show(message, type = 'info', duration = 5000) {
        const notification = document.createElement('div');
        notification.className = `notification ${type}`;
        notification.textContent = message;

        this.container.appendChild(notification);

        setTimeout(() => {
            notification.classList.add('fade-out');
            setTimeout(() => {
                this.container.removeChild(notification);
            }, 500);
        }, duration);
    }

    error(message) {
        this.show(message, 'error');
    }

    success(message) {
        this.show(message, 'success');
    }

    warn(message) {
        this.show(message, 'warning');
    }
}