import {get_value, suppress_context_menu_once} from "../helpers.js"




let crud_table = document.getElementsByClassName('crud-table')[0]
function is_editor(element) {return element.tagName === 'INPUT' || element.tagName === 'SELECT'}


function copy_input_value_by_hold(event)
{
    let copy_element = document.elementFromPoint(event.clientX, event.clientY)
    if (!is_editor(copy_element)) {return}
    let copy_value = get_value(copy_element)

    crud_table.addEventListener('mousemove', (event)=>{
        let hovered_element = document.elementFromPoint(event.clientX, event.clientY)

        if (is_editor(hovered_element) && event.which === 3 && hovered_element.tagName === copy_element.tagName) {
            if (copy_element.type !== hovered_element.type || hovered_element.disabled) {return}
            hovered_element.value = copy_value
            hovered_element.focus()
        }
    })
}


crud_table.addEventListener('mousedown', (event)=>{
    if (event.which === 3) {copy_input_value_by_hold(event)}
    suppress_context_menu_once()
})

