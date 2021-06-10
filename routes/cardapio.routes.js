module.exports = app => {
    const cardapio = require('../controllers/cardapio.controller');

    // Busca todos os cardapios
    app.get("/cardapio", cardapio.findAll);
}