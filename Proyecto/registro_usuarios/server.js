const express = require('express');
const mysql = require('mysql');
const bodyParser = require('body-parser');

const app = express();
const port = 3000;

// Configuración de MySQL
const connection = mysql.createConnection({
  host: 'tu_host_de_base_de_datos',
  user: 'tu_usuario',
  password: 'tu_contraseña',
  database: 'tu_base_de_datos'
});

// Conexión a la base de datos
connection.connect((err) => {
  if (err) {
    console.error('Error al conectar a la base de datos: ' + err.stack);
    return;
  }
  console.log('Conexión exitosa a la base de datos');
});

// Middleware para analizar el cuerpo de las solicitudes
app.use(bodyParser.urlencoded({ extended: false }));
app.use(bodyParser.json());

// Ruta para manejar el registro de usuarios
app.post('/registro', (req, res) => {
  const { nombre, email, telefono, password } = req.body;
  const query = 'INSERT INTO usuarios (Nombre, Email, Num_tel, Contraseña) VALUES (?, ?, ?, ?)';
  connection.query(query, [nombre, email, telefono, password], (err, result) => {
    if (err) {
      console.error('Error al registrar usuario: ' + err.stack);
      res.status(500).send('Error interno del servidor');
      return;
    }
    console.log('Usuario registrado exitosamente');
    res.status(200).send('Usuario registrado exitosamente');
  });
});

// Iniciar el servidor
app.listen(port, () => {
  console.log(`Servidor escuchando en el puerto ${port}`);
});
