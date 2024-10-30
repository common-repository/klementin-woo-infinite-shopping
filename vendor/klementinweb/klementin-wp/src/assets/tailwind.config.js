const fs = require('fs');

var userConfig = '../../klementin-wp-tailwind-config.js';

var standardConfig = {
    prefix: 'kl-wp-',
    content: ["../../views/*.php"],
    theme: {
        extend: {},
    },
    plugins: [],
}


if (fs.existsSync(userConfig)) {
    userConfig = require(userConfig);
    standardConfig = {...standardConfig, ...userConfig};
}

module.exports = standardConfig;