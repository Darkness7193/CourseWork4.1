import { msleep, set_is_mouse_down } from './helpers.js'

function disable_context_menu(event) { event.preventDefault() }
set_is_mouse_down()


function suppress_context_menu_once() {
    document.addEventListener('mouseup', function activate_context_menu(event) {
        event.currentTarget.removeEventListener(event.type, activate_context_menu)
        msleep(50).then(()=>{ window.removeEventListener(`contextmenu`, disable_context_menu) })
    })
}


function activate_by_hold_cursor_entering(element) {
    element.addEventListener("mouseenter", (event) => {
        if (is_mouse_down) {
            element.click()
            window.addEventListener(`contextmenu`, disable_context_menu)
            suppress_context_menu_once()
        }
    })
}


[...document.getElementsByClassName('delete-btn')].forEach((delete_btn)=>{
    activate_by_hold_cursor_entering(delete_btn)
})


