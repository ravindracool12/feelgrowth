<?php

namespace App\Services;

use BlockCypher\Rest\ApiContext;
use BlockCypher\Auth\SimpleTokenCredential;

class BlockCypher {

    protected $apiContext;

    /**
     * Create the BlockCypher instance
     * @param string $coin
     */
    public function __construct($coin='btc') {
        $this->apiContext = ApiContext::create(
            'test', $coin, 'v1',
            new SimpleTokenCredential(env('BLOCKCYPHER_TOKEN')),
            [
                'mode' => 'sandbox',
                'log.LogEnabled' => true,
                'log.FileName' => storage_path () . '/logs/bc-' . date('d') . '-' . date('m') .'.log',
                'log.LogLevel' => 'DEBUG', // PLEASE USE 'INFO' LEVEL FOR LOGGING IN LIVE ENVIRONMENTS
                'validation.level' => 'log',
            ]
        );
    }

    public function convertToBTC($value){
        return bcdiv( intval($value), 100000000, 8 );
    }

    /**
     * Generate New Address
     * @param $name
     * @return json
     */
    public function generateNewAddress () {
        $addressClient = new \BlockCypher\Client\AddressClient($this->apiContext);
        
        /**
         * { "private": "fabf66039e0d8a4bdb08baf88bdac9ad7ecadc0dcd057f73a82a596ad024126a", "public": "028b11e4cf5dc00a114f64a39ad68234773cd858169b99cadb1e8859db1fd24ae1", "address": "12MYvZh9xfGgYC3q3Rq4zvWLqAFXBjHtmU", "wif": "L5d8an7bhqyQb5cKSMEXYigdncNaMv8nv9CSLpD4KUb8jegpfmNa" }
         */
        
        return $addressClient->generateAddress();
    }

    /**
     * Add Address To Wallet
     * @param string $walletName
     * @param array $address
     * @return json
     */
    public function addAddressToWallet ($walletName, $address=[]) {
        $walletClient = new \BlockCypher\Client\WalletClient($this->apiContext);
        $addressList = \BlockCypher\Api\AddressList::fromAddressesArray($address);
        $output = $walletClient->addAddresses($walletName, $addressList);
        return $output;
    }

    /**
     * Get address detail
     * @param string $address
     * @return json
     */
    public function getAddressDetail ($address) {
        $addressClient = new \BlockCypher\Client\AddressClient($this->apiContext);
        $address = $addressClient->get($address, [], $this->apiContext);

        /**
         * { "address": "1P6r37EhR28YXqtSYTH4G8CFgKZD89FJ36", "total_received": 0, "total_sent": 0, "balance": 0, "unconfirmed_balance": 0, "final_balance": 0, "n_tx": 0, "unconfirmed_n_tx": 0, "final_n_tx": 0, "tx_url": "https://api.blockcypher.com/v1/btc/main/txs/" }
         */
        
        return $address;
    }

    /**
     * Generate New Wallet
     * @param string $name 
     * @param array $address
     * @return json
     */
    public function generateNewWallet ($name, $address=[]) {
        $wallet = new \BlockCypher\Api\Wallet();
        $wallet->setName($name);
        // $wallet->setAddresses($address);

        $walletClient = new \BlockCypher\Client\WalletClient($this->apiContext);
        $output = $walletClient->create($wallet);

        /**
         * { "token": "8ad5d84c879f4a0d8537fb481bbdc103", "name": "test", "addresses": [ "1P6r37EhR28YXqtSYTH4G8CFgKZD89FJ36" ] }
         */
        
        return $output;
    }

    /**
     * Delete Wallet
     * @param string $walletName
     * @return json
     */
    public function deleteWallet ($walletName) {
        $walletClient = new \BlockCypher\Client\WalletClient($this->apiContext);
        $output = $walletClient->delete($walletName);
        return $output;
    }

    /**
     * Get Wallet Detail
     * @param string $name
     * @return json
     */
    public function getWalletDetail ($name) {
        $walletClient = new \BlockCypher\Client\WalletClient($this->apiContext);
        $output = $walletClient->get($name);
        return $output;
    }

    /**
     * Get Transaction Detail
     * @param string $hash
     * @return json
     */
    public function getTransactionDetail ($hash) {
        $txClient = new \BlockCypher\Client\TXClient($this->apiContext);
        $output = $txClient->get($hash);
        // { "block_hash": "0000f0a8412b544c2dcb37a20ad91092be111a6a38370243bdd99cfe2a945262", "block_height": 1578497, "block_index": 1, "hash": "43174601c2bfc124393cbb962fc5a2df840bd1400be2e384c820402e6a3befdf", "addresses": [ "CCqqcruarqEH9w8dAcdYxTCSvZ7hD73DgF", "CDYTwVbaZTwpphZv4TdA5RxJx1QC6dC5PJ" ], "total": 112600, "fees": 187400, "size": 372, "preference": "high", "relayed_by": "202.62.19.77", "confirmed": "2017-11-15T11:57:00Z", "received": "2017-11-15T11:56:44.929Z", "ver": 1, "double_spend": false, "vin_sz": 2, "vout_sz": 2, "confirmations": 3, "confidence": 1, "inputs": [ { "prev_hash": "822e8d7285ff14a379c08ca239070079d89a06675a16a7316f7256963de5957e", "output_index": 0, "script": "47304402204ccd672dfc38c62397cf18d62a70813f22f3b3dad141c24aff0a7f38948c73370220090854e0deda37e6b56dd5306fd892c62e4646f7992f46512dbaef4269b1a37d012103393f51e4afdb1f0167156e1a4f994a45857580c5074fe554100d9b4957d96eb3", "output_value": 100000, "sequence": 4294967295, "addresses": [ "CCqqcruarqEH9w8dAcdYxTCSvZ7hD73DgF" ], "script_type": "pay-to-pubkey-hash", "age": 1578229 }, { "prev_hash": "fb4be5a3565b1c77acbd184e775c38c91a722e49b9c695aa3b2c1c889aa5fce1", "output_index": 0, "script": "473044022047a538ae2ca6c4ffa323fd24b5645773534661a9509087ce0c4b35e60e745493022062fa2fb365a1400b07ecdc608511e8d0a524df9417fa5e57c093aeb7af59c11e012103393f51e4afdb1f0167156e1a4f994a45857580c5074fe554100d9b4957d96eb3", "output_value": 200000, "sequence": 4294967295, "addresses": [ "CCqqcruarqEH9w8dAcdYxTCSvZ7hD73DgF" ], "script_type": "pay-to-pubkey-hash", "age": 1578278 } ], "outputs": [ { "value": 100000, "script": "76a914dff5246b4e58eca2f905cc37273d427c983b6a1588ac", "addresses": [ "CDYTwVbaZTwpphZv4TdA5RxJx1QC6dC5PJ" ], "script_type": "pay-to-pubkey-hash" }, { "value": 12600, "script": "76a914d8462f30b639ce305c8f7f441f2f4ca3fea016e388ac", "addresses": [ "CCqqcruarqEH9w8dAcdYxTCSvZ7hD73DgF" ], "script_type": "pay-to-pubkey-hash" } ] }
        return $output;
    }

    /**
     * Create Transaction
     * @param string $from
     * @param string $to
     * @param float $amount
     * @param string $key
     * @return json
     */
    public function createTx ($from, $to, $amount, $key) {
        $input = new \BlockCypher\Api\TXInput();
        $input->addAddress($from);

        $output = new \BlockCypher\Api\TXOutput();
        $output->addAddress($to);
        $amount = $amount * 100000000;
        $output->setValue((int) $amount);

        $tx = new \BlockCypher\Api\TX();
        $tx->addInput($input);
        $tx->addOutput($output);

        $txClient = new \BlockCypher\Client\TXClient($this->apiContext);
        $txSkeleton = $txClient->create($tx);

        $txSkeleton = $txClient->sign($txSkeleton, [$key]);
        $output = $txClient->send($txSkeleton);

        // { "tx": { "block_height": -1, "block_index": -1, "hash": "43174601c2bfc124393cbb962fc5a2df840bd1400be2e384c820402e6a3befdf", "addresses": [ "CCqqcruarqEH9w8dAcdYxTCSvZ7hD73DgF", "CDYTwVbaZTwpphZv4TdA5RxJx1QC6dC5PJ" ], "total": 112600, "fees": 187400, "size": 372, "preference": "high", "relayed_by": "202.62.19.77", "received": "2017-11-15T11:56:44.923247547Z", "ver": 1, "double_spend": false, "vin_sz": 2, "vout_sz": 2, "confirmations": 0, "inputs": [ { "prev_hash": "822e8d7285ff14a379c08ca239070079d89a06675a16a7316f7256963de5957e", "output_index": 0, "script": "47304402204ccd672dfc38c62397cf18d62a70813f22f3b3dad141c24aff0a7f38948c73370220090854e0deda37e6b56dd5306fd892c62e4646f7992f46512dbaef4269b1a37d012103393f51e4afdb1f0167156e1a4f994a45857580c5074fe554100d9b4957d96eb3", "output_value": 100000, "sequence": 4294967295, "addresses": [ "CCqqcruarqEH9w8dAcdYxTCSvZ7hD73DgF" ], "script_type": "pay-to-pubkey-hash", "age": 1578229 }, { "prev_hash": "fb4be5a3565b1c77acbd184e775c38c91a722e49b9c695aa3b2c1c889aa5fce1", "output_index": 0, "script": "473044022047a538ae2ca6c4ffa323fd24b5645773534661a9509087ce0c4b35e60e745493022062fa2fb365a1400b07ecdc608511e8d0a524df9417fa5e57c093aeb7af59c11e012103393f51e4afdb1f0167156e1a4f994a45857580c5074fe554100d9b4957d96eb3", "output_value": 200000, "sequence": 4294967295, "addresses": [ "CCqqcruarqEH9w8dAcdYxTCSvZ7hD73DgF" ], "script_type": "pay-to-pubkey-hash", "age": 1578278 } ], "outputs": [ { "value": 100000, "script": "76a914dff5246b4e58eca2f905cc37273d427c983b6a1588ac", "addresses": [ "CDYTwVbaZTwpphZv4TdA5RxJx1QC6dC5PJ" ], "script_type": "pay-to-pubkey-hash" }, { "value": 12600, "script": "76a914d8462f30b639ce305c8f7f441f2f4ca3fea016e388ac", "addresses": [ "CCqqcruarqEH9w8dAcdYxTCSvZ7hD73DgF" ], "script_type": "pay-to-pubkey-hash" } ] }, "tosign": [ "", "" ] }

        return $output;
    }

    public function testAddress () {
        $addressClient = new \BlockCypher\Client\AddressClient($this->apiContext);
        $output = $addressClient->generateAddress();
        return $output;
    }

    public function testFaucet () {
        $faucetClient = new \BlockCypher\Client\FaucetClient($this->apiContext);
        $faucetResponse = $faucetClient->fundAddress('CBv8P3NoGDVQGFQhyp3qB4HZktbgYx2dzQ', 100000000);
        // { "tx_ref": "2e726bdc31162c973091000a779d35e5af08d04c89e4011b8827a05c49007f75" }
        return $faucetResponse;
    }

    public function testTx () {
        $input = new \BlockCypher\Api\TXInput();
        $input->addAddress("CCqqcruarqEH9w8dAcdYxTCSvZ7hD73DgF");
        $output = new \BlockCypher\Api\TXOutput();
        $output->addAddress("CDYTwVbaZTwpphZv4TdA5RxJx1QC6dC5PJ");
        $output->setValue(0.001 * 100000000);

        $tx = new \BlockCypher\Api\TX();
        $tx->addInput($input);
        $tx->addOutput($output);
        $txClient = new \BlockCypher\Client\TXClient($this->apiContext);
        $txSkeleton = $txClient->create($tx);

        $txSkeleton = $txClient->sign($txSkeleton, ["f8de641fff1dc4b8afad8a5497032e02a4a77131d4c7bc89b15dd70597c0854d"]);
        $output = $txClient->send($txSkeleton);
        return $output;
    }
}