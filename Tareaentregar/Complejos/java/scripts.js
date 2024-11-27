document.addEventListener('DOMContentLoaded', function() {
    // Cambiar tema (oscuro/claro) al hacer clic en el ícono de la luna
    const themeToggle = document.getElementById("themeToggle");

    themeToggle.addEventListener('click', function() {
        const currentTheme = document.body.getAttribute("data-theme");

        // Cambiar entre temas oscuro y claro
        if (currentTheme === "dark") {
            document.body.setAttribute("data-theme", "light");
        } else {
            document.body.setAttribute("data-theme", "dark");
        }
    });

    // Funcionalidad para cargar contenido dinámico en función de la sección
    document.querySelectorAll('.menu-item').forEach(item => {
        item.addEventListener('click', function() {
            const section = this.getAttribute('data-section');
            loadContent(section);
        });
    });

    function loadContent(section) {
        const dynamicContent = document.querySelector('.dynamic-content');
        switch (section) {
            case 'inicio':
                dynamicContent.innerHTML = `<h2>Inicio</h2><p>Contenido para la sección de Inicio.</p>`;
                break;
            case 'usuarios':
                dynamicContent.innerHTML = `<h2>Administración de Usuarios</h2><div id="userList"></div>`;
                loadUsers();
                break;
            case 'contenido':
                dynamicContent.innerHTML = `<h2>Contenido</h2><form id="uploadContentForm">
                    <input type="text" name="title" placeholder="Título del contenido" required>
                    <textarea name="description" placeholder="Descripción" required></textarea>
                    <input type="file" name="image" accept="image/*" required>
                    <button type="submit">Subir</button>
                </form>`;
                handleContentUpload();
                break;
            case 'stats':
                dynamicContent.innerHTML = `<h2>Estadísticas</h2><div id="statChartContainer">
                    <canvas id="myChart"></canvas>
                    <div class="circle-percentage">
                        <span class="percentage-value">75%</span>
                    </div>
                </div>`;
                loadChart();
                break;
            case 'settings':
                dynamicContent.innerHTML = `<h2>Configuración</h2><p>Aquí puedes ajustar la configuración de la página.</p>`;
                break;
            default:
                dynamicContent.innerHTML = `<h2>${section.charAt(0).toUpperCase() + section.slice(1)}</h2><p>Contenido para la sección de ${section}.</p>`;
        }
    }

    // Inicializar con la sección de inicio
    loadContent('inicio');

    // Función para cargar usuarios
    function loadUsers() {
        const userList = document.getElementById('userList');
        const users = [
            { name: 'Juan Pérez', role: 'Administrador', avatar: 'https://randomuser.me/api/portraits/men/1.jpg' },
            { name: 'María López', role: 'Editor', avatar: 'https://randomuser.me/api/portraits/women/1.jpg' },
            { name: 'Carlos García', role: 'Usuario', avatar: 'https://randomuser.me/api/portraits/men/2.jpg' }
        ];
        users.forEach(user => {
            const userItem = document.createElement('div');
            userItem.classList.add('user-item');
            userItem.innerHTML = `
                <img src="${user.avatar}" alt="${user.name}" class="user-avatar">
                <span>${user.name} (${user.role})</span>
                <button class="edit-btn">Editar</button>
                <button class="delete-btn">Eliminar</button>
            `;
            userList.appendChild(userItem);
        });
    }

    // Función para manejar la subida de contenido
    function handleContentUpload() {
        const form = document.getElementById('uploadContentForm');
        form.onsubmit = function(event) {
            event.preventDefault();
            alert('Contenido subido con éxito.');
        };
    }

    // Función para cargar gráfico
    function loadChart() {
        var ctx = document.getElementById('myChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Enero', 'Febrero', 'Marzo', 'Abril'],
                datasets: [{
                    label: 'Visitas al sitio',
                    data: [12, 19, 3, 5],
                    backgroundColor: 'rgba(0, 123, 255, 0.5)',
                    borderColor: 'rgba(0, 123, 255, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }
});
