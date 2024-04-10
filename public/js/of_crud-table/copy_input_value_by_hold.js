import {get_value, set_is_mouse_down, suppress_context_menu_once} from "../helpers.js"




set_is_mouse_down()
let crud_table = document.getElementsByClassName('crud-table')[0]


function copy_input_value_by_hold(event)
{
    let copy_element = document.elementFromPoint(event.clientX, event.clientY)
    let is_editor = ()=>{ return copy_element.tagName === 'INPUT' || copy_element.tagName === 'SELECT' }

    if (is_editor() && is_mouse_down) {
        let copy_value = get_value(copy_element)

        crud_table.addEventListener('mousemove', (event)=>{
            let hovered_element = document.elementFromPoint(event.clientX, event.clientY)
            let is_editor = ()=>{ return hovered_element.tagName === 'INPUT' || hovered_element.tagName === 'SELECT' }

            if (is_editor() && is_mouse_down && event.which === 3 && hovered_element.tagName === copy_element.tagName && hovered_element.type === copy_element.type) {
                hovered_element.value = copy_value
                hovered_element.focus()
                suppress_context_menu_once()
            }
        })
    }
}


crud_table.addEventListener('mousedown', (event)=>{
    if (event.which === 3) {copy_input_value_by_hold(event)}
})

