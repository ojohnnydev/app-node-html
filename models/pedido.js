const sql = require("./db");

const Pedido = function (Pedido) {
    this.cliente = Pedido.cliente;
    this.prato = Pedido.prato;
    this.data = Pedido.data;
}

Pedido.create = (newOrder, result) => {
    sql.query("INSERT INTO pedido SET ?", newOrder, (err, res) => {
        if (err) {
            console.log("Erro: ", err);
            result(err, null);
            return;
        }

        console.log("Pedido criado: ", { id: res.insertId, ...newOrder });
        result(null, { id: res.insertId, ...newOrder });
    });
};

Pedido.findByClient = (clientId, result) => {
    sql.query('SELECT p.*, c.item_1, c.item_2, c.item_3, c.salada, c.carne, c.bebida, c.sobremesa ' +
        'FROM pedido p JOIN cardapio c ON p.prato = c.id WHERE cliente = ?', [clientId] , (err, res) => {
        if (err) {
            console.log("Erro: ", err);
            result(err, null);
            return;
        }

        if (res.length) {
            console.log("Pedido(s) encontrado(s): ", res);
            result(null, res);
            return;
        }

        // Pedido não encontrado com o id passado
        result({ kind: "Pedido(s) não encontrado!" }, null);
    });
};

module.exports = Pedido;