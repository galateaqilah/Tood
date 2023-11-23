const cursor=document.getElementById('cursor');
const cursorBorder = document.getElementById('cursor-border');

let 
cursorX = 0,
cursorY = 0,
borderY = 0,
borderX = 0;

let deviceType = '';
// check if it is a touch device
const isTouchDevice = () => {
    try {
        document.createEvent('TouchEvent');
        deviceType = 'touch';
        return true;
    } catch (e) {
        deviceType = 'mouse'
        return false;
    }
};

// moving
const move = (e) => {
    cursorX = !isTouchDevice() ? e.clientX : e.touches[0].clientX;
    cursorY = !isTouchDevice() ? e.clientY : e.touches[0].clientX;
    cursor.style.left = `${cursorX}px`;
    cursor.style.top = `${cursorY}px`;
};

document.addEventListener('mousemove', (e) => {
    move(e);
});

document.addEventListener('touchmove', (e) => {
    move(e);
});

document.addEventListener('touchend', (e) => {
    e.preventDefault();
});

// animate border
const borderAnimation = () => {
    const gapValue = 1;
    borderX += (cursorX - borderX) / gapValue;
    borderY += (cursorY - borderY) / gapValue;
    cursorBorder.style.left = `${borderX}px`;
    cursorBorder.style.top = `${borderY}px`;
    requestAnimationFrame(borderAnimation);
};
requestAnimationFrame(borderAnimation);