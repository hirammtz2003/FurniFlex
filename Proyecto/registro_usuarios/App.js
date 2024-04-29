import React from 'react';

function App() {
  return (
    <div className="container">
      <h1>Registro de Usuarios</h1>
      <form id="registration-form">
        <input type="text" id="nombre" placeholder="Nombre" required />
        <input type="email" id="email" placeholder="Email" required />
        <input type="tel" id="telefono" placeholder="Teléfono" required />
        <input type="password" id="password" placeholder="Contraseña" required />
        <input type="password" id="confirm-password" placeholder="Confirmar Contraseña" required />
        <button type="submit">Guardar</button>
      </form>
    </div>
  );
}

export default App;