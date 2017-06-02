window.jQuery = window.$ = require('jquery');
require('velocity-animate');
require('materialize-css');
require('./scripts/spiral/vault');
require('./styles/spiral/vault/vault.scss');

// We don't really export anything, just filling globals
module.exports = "Vault Global Modules PLUS Styles. This module has no exports. It populates global environment.";
