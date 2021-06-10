module.exports = app => {
    const pedido = require('../controllers/pedido.controller');

    // Cria um novo pedido
    app.post("/pedido", pedido.create);

    // Busca todos os pedido(s) do cliente
    app.get("/pedido/:clientId", pedido.findOrdersClient);
}