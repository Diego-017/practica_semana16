<template>
    <div>
        <h1>Registro de Películas</h1>
        
        <div class="form-container">
            <h2>Agregar Nueva Película</h2>
            <form @submit.prevent="agregarPelicula">
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input v-model="nuevaPelicula.nombre" type="text" id="nombre" required>
                </div>
                <div class="form-group">
                    <label for="duracion">Duración:</label>
                    <input v-model="nuevaPelicula.duracion" type="number" id="duracion" required>
                </div>
                <div class="form-group">
                    <label for="categoria">Categoría:</label>
                    <input v-model="nuevaPelicula.categoria" type="text" id="categoria" required>
                </div>
                <div class="form-group">
                    <label for="fecha">Fecha de Estreno:</label>
                    <input v-model="nuevaPelicula.fecha_estreno" type="text" id="fecha" placeholder="YYYY-MM-DD" required>
                </div>
                <button type="submit" class="btn">Agregar Película</button>
                <p v-if="mensaje" :class="{ success: tipoMensaje === 'success', error: tipoMensaje === 'error' }">
                    {{ mensaje }}
                </p>
            </form>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Duración</th>
                    <th>Categoría</th>
                    <th>Fecha de Estreno</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="pelicula in peliculas" :key="pelicula.id">
                    <td>{{ pelicula.nombre }}</td>
                    <td>{{ pelicula.duracion }}</td>
                    <td>{{ pelicula.categoria }}</td>
                    <td>{{ pelicula.fecha_estreno }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import { ref, onMounted } from 'vue';
import axios from 'axios';

export default {
    setup() {
        const peliculas = ref([]);
        const mensaje = ref('');
        const tipoMensaje = ref('');
        const nuevaPelicula = ref({
            nombre: '',
            duracion: '',
            categoria: '',
            fecha_estreno: ''
        });
        
        const lista = async () => {
            try {
                const response = await axios.get('/peliculas');
                peliculas.value = response.data;
            } catch (error) {
                console.error('Error al cargar películas:', error);
            }
        }
        
        const agregarPelicula = async () => {
            try {
                await axios.post('/peliculas', nuevaPelicula.value);
                mensaje.value = 'Película agregada exitosamente';
                tipoMensaje.value = 'success';
                nuevaPelicula.value = {
                    nombre: '',
                    duracion: '',
                    categoria: '',
                    fecha_estreno: ''
                };
                setTimeout(() => {
                    mensaje.value = '';
                }, 3000);
                await lista();
            } catch (error) {
                mensaje.value = 'Error al agregar la película';
                tipoMensaje.value = 'error';
                console.error('Error:', error);
            }
        }
        
        onMounted(() => {
            lista();
        });
        
        return {
            peliculas,
            nuevaPelicula,
            agregarPelicula,
            mensaje,
            tipoMensaje
        }
    }
}
</script>

<style scoped>
h1 {
    font-size: 24px;
    margin-bottom: 20px;
}

h2 {
    font-size: 18px;
    margin-bottom: 15px;
}

.form-container {
    background-color: #f9f9f9;
    border: 1px solid #ddd;
    padding: 20px;
    border-radius: 5px;
    margin-bottom: 30px;
}

form {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.form-group {
    display: flex;
    flex-direction: column;
}

label {
    font-weight: bold;
    margin-bottom: 5px;
}

input {
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 14px;
}

input:focus {
    outline: none;
    border-color: #4CAF50;
    box-shadow: 0 0 5px rgba(76, 175, 80, 0.3);
}

.btn {
    background-color: #007bff;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s;
}

.btn:hover {
    background-color: #0056b3;
}

.mensaje {
    margin-top: 10px;
    padding: 10px;
    border-radius: 4px;
    text-align: center;
}

.mensaje.success {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.mensaje.error {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th, td {
    border: 1px solid #ddd;
    padding: 12px;
    text-align: left;
}

th {
    background-color: #f2f2f2;
}

tr:hover {
    background-color: #f5f5f5;
}
</style>
