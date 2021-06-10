module.exports = app => {
    const clientes = require('../controllers/clientes.controller');

    // Cria um novo usuario
    app.post("/clientes", clientes.create);

    // Busca cliente pelos dados passados
    app.post("/login", clientes.login);
}