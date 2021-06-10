const Cardapio = require('../models/cardapio');

// Busca todos os cardapios
exports.findAll = (req, res) => {
    Cardapio.getAll((err, data) => {
        if (err)
            res.status(500).send({
                message:
                    err.message || "Ocorreu algum erro durante a busca dos cardapios!"
            });
        else res.send(data);
    });
};