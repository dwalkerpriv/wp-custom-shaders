jQuery(document).ready(function ($) {
    const canvas = document.getElementById("wp-custom-shaders-canvas");
    canvas.width = window.innerWidth;
    let sandbox = new GlslCanvas(canvas);

    function size() {
        let width = canvas.parentElement.offsetWidth;
        let height = canvas.parentElement.offsetHeight;
        let dpi = window.devicePixelRatio;

        canvas.width = canvas.width;
        canvas.height = canvas.height;
        canvas.style.width = canvas.style.width + "px";
        canvas.style.height = canvas.style.height + "px";
    }

    const pluginDirectory = plugin_directory_uri;
    const hex_tl = custom_hex_tl;
    const hex_tr = custom_hex_tr;
    const hex_bl = custom_hex_bl;
    const hex_br = custom_hex_br;
    const speed = parseFloat(custom_speed);

    function hex2rgb(hex) {
        let r = parseInt(hex.slice(1, 3), 16);
        let g = parseInt(hex.slice(3, 5), 16);
        let b = parseInt(hex.slice(5, 7), 16);

        return [r, g, b];
    }

    sandbox.load(fragment);
    sandbox.setUniform(
        "displacement",
        pluginDirectory + "app/assets/displacement.jpg"
    );
    sandbox.setUniform("hex_tl", hex2rgb(hex_tl));
    sandbox.setUniform("hex_tr", hex2rgb(hex_tr));
    sandbox.setUniform("hex_bl", hex2rgb(hex_bl));
    sandbox.setUniform("hex_br", hex2rgb(hex_br));
    sandbox.setUniform("speed", speed);
});
