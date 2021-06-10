const Pedido = require('../models/pedido');

// Cria e Salva um novo pedido
exports.create = (req, res) => {
    // Valida a requisição
    if (!req.body) {
        res.status(400).send({
            message: "Os dados não podem ser vazios!"
        });
    }

    // Cria um novo pedido
    const pedido = new Pedido({
        cliente: req.body.cliente,
        prato: req.body.prato,
        data: req.body.data
    });

    // Salva pedido criado no banco
    Pedido.create(pedido, (err, data) => {
        if (err)
            res.status(500).send({
                message:
                    err.message || "Ocorreu algum erro durante a criação do pedido!"
            });
        else res.send(data);
    });
};

// Busca pedido(s) pelo id do cliente
exports.findOrdersClient = (req, res) => {
    Pedido.findByClient(req.params.clientId, (err, data) => {
        if (err) {
            if (err.kind === "Pedido não encontrado!") {
                res.status(404).send({
                    message: `Não foi possível encontrar o pedido com o id do cliente ${req.params.clientId}!`
                });
            } else {
                res.status(500).send({
                    message: "Erro ao buscar o pedido com o id do cliente " + req.params.clientId
                });
            }
        } else res.send(data);
    });
};