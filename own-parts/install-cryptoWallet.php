<?php

/**
 * The default template for displaying content
 *
 * Used for both singular and index.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0.0
 */

?>
<!-- Modal/Popup for installCryptoWalletModal -->
<div class="modal fade" id="installCryptoWalletModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <!-- Header -->
            <div class="modal-header">

                <h5 class="modal-title text-left" id="exampleModalLabel">Please install MetaMask</h5>
            </div>

            <!-- Body -->
            <div class="modal-body">
                <p class="modal-body-p" id="installCryptoWalletModalBody">For the following actions is a blockchain plugin required: MetaMask</p>
                <a href="https://metamask.io/download.html" target="_blank">
                    <img class="img-centered" src="https://stockvoting.net/wp-content/uploads/2020/05/download-metamask.png" width="150" height="120" alt="Italian Trulli">
                </a>
            </div>

            <!-- Footer group -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<script>
    // Front End functions
    $(document).ready(function() {
        if (typeof web3 == 'undefined') {
            // Please install MetaMask first
            $('#installCryptoWalletModal').modal('show');
        }
    });
</script>