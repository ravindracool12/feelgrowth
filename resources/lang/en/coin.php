<?php

return [
    // messages
    'walletSuccess' => 'Wallet created successfully',
    'walletNotFound' => 'Coin wallet not found.',
    'walletOwnerError' => 'You are not the owner of this wallet.',
    'walletRemove' => 'Wallet removed.',
    'txError' => 'Transaction type not recognized',
    'txOwnerError' => 'You are not the owner of this transaction.',
    'txSuccess' => 'Transaction created successfully.',
    'addressNotFound' => 'Address not found.',
    'addressGenerateError' => 'Something wrong generating the address. Try again later.',
    'addressSuccess' => 'Address created successfully.',
    'endpointError' => 'Coin type endpoint not found.',
    'fundNotEnough' => 'Fund is not enough.',

    // other
    'detailBtnLbl' => 'Detail',
    'addAddressBtnLbl' => 'Add Address',
    'removeBtnLbl' => 'Remove',

    // address details
    'detail.address.address' => 'ADDRESS',
    'detail.address.balance' => 'Balance',
    'detail.address.ubalance' => 'Unconfirmed Balance',
    'detail.address.fbalance' => 'Final Balance',
    'detail.address.totalSent' => 'Total Sent',
    'detail.address.totalReceived' => 'Total Received',
    'detail.address.ntx' => 'Number of Transaction',
    'detail.address.untx' => 'Unconfirmed Transaction',
    'detail.address.tntx' => 'Total Transaction',

    // tx page
    'tx.title' => 'My Transaction',
    'tx.sub' => 'All my transactions.',
    'tx.createNew' => 'Create New transaction',
    'tx.createNew.from' => 'From Address',
    'tx.createNew.to' => 'To Address',
    'tx.createNew.amount' => 'Amount',
    'tx.createNew.help' => '>Admin Fee 2%. Use dot(.) as commas',
    'tx.createNew.total' => 'Total',
    'tx.table.date' => 'Created At',
    'tx.table.amount' => 'Amount',
    'tx.table.from' => 'From',
    'tx.table.to' => 'To',
    'tx.modal.title' => 'Transaction Detail',

    // tx detail
    'tx.detail.amtTrans' => 'AMOUNT TRANSACTED',
    'tx.detail.fee' => 'FEES',
    'tx.detail.received' => 'RECEIVED',
    'tx.detail.confirm' => 'CONFIRMATIONS',
    'tx.detail.confirmDetail' => 'Anything over 6 confirmations is considered completed and irreversible.',
    'tx.detail.pref' => 'Miner Preference',
    'tx.detail.blockHash' => 'Block Hash',
    'tx.detail.blockHeight' => 'Block Height',
    'tx.detail.size' => 'Size',
    'tx.detail.relay' => 'Relayed By',
    'tx.detail.input' => 'inputs consumed.',
    'tx.detail.from' => 'from:',
    'tx.detail.output' => 'outputs created.',
    'tx.detail.to' => 'to:',

    // wallet page
    'wallet.title' => 'My Wallet',
    'wallet.sub' => 'All my Coin Wallets',
    'wallet.createNew' => 'Create New Wallet',
    'wallet.createNew.name' => 'Wallet Name',
    'wallet.createNew.type' => 'Coin Type',
    'wallet.createNew.btc' => 'Bitcoin',
    'wallet.createNew.eth' => 'Ethereum',
    'wallet.createNew.lite' => 'Litecoin',
    'wallet.createNew.doge' => 'Dogecoin',
    'wallet.table.date' => 'Created at',
    'wallet.table.name' => 'Wallet Name',
    'wallet.table.type' => 'Coin Type',

    // wallet detail
    'wallet.detail.title' => 'Wallet Detail',
    'wallet.detail.list' => 'Wallet List',
    'wallet.detail.pageTitle' => 'Wallet:',
    'wallet.detail.dateTitle' => 'Created On:',
    'wallet.detail.table.address' => 'Address',
    'wallet.detail.table.private' => 'Private Key',
    'wallet.detail.table.date' => 'Created On',
    'wallet.detail.table.check' => 'Check Funds',
    'wallet.modal.address.title' => 'Address Detail',
];
