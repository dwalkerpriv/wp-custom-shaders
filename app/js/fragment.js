const fragment = `
#ifdef GL_ES
precision highp float;
#endif

uniform float u_time;
uniform sampler2D displacement;
uniform vec3 hex_tl[3];
uniform vec3 hex_tr[3];
uniform vec3 hex_bl[3];
uniform vec3 hex_br[3];
uniform float speed;

varying vec2 v_texcoord;

vec4 rgb(float r, float g, float b) {
    return vec4(r/ 255.0, g/ 255.0, b / 255.0, 1.0);
}

void main(void) {
    vec2 uv = v_texcoord;
    
    vec2 point = fract(uv * 0.5 + u_time * speed);

    vec4 dispColor = texture2D(displacement, point);

    vec4 tl = rgb(hex_tl[0][0], hex_tl[0][1],hex_tl[0][2]);
    vec4 tr = rgb(hex_tr[0][0], hex_tr[0][1], hex_tr[0][2]);
    vec4 bl = rgb(hex_bl[0][0], hex_bl[0][1], hex_bl[0][2]);
    vec4 br = rgb(hex_br[0][0], hex_br[0][1], hex_br[0][2]);

    float dispX = mix (-0.5, 0.5, dispColor.r);
    float dispY= mix(-0.5, 0.5, dispColor.g);

    vec4 color = mix(
        mix (bl, br, uv.x - dispX),
        mix(tl, tr, uv.x + dispX),
        uv.y + dispY
    );

    gl_FragColor = color;
}
`;
