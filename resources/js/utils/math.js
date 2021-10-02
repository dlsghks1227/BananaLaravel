export const randMinMax = function(min, max, round) {
    var val = min + (Math.random() * (max - min));
    if (round) {
        val = Math.round( val );
    }

    return val;
}

export const ToRadian = function(degree) {
    // PI / 180 = 0.01745329251
    return degree * 0.01745329251;
}

export const getAngle = function(x1, y1, x2, y2) {
    const   dx = x1 - x2,
            dy = y1 - y2;
    
    return Math.atan2(dy, dx);
}

export const getDistance = function(x1, y1, x2, y2) {
    const   xs = (x2 - x1) * (x2 - x1),
            ys = (y2 - y1) * (y2 - y1);

    return Math.sqrt( xs + ys );
}