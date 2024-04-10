import {get_value, suppress_context_menu_once} from "../helpers.js"




let crud_table = document.getElementsByClassName('crud-table')[0]


function copy_input_value_by_hold(event)
{
    let copy_element = document.elementFromPoint(event.clientX, event.clientY)
    if (copy_element.tagName !== 'INPUT' && copy_element.tagName !== 'SELECT') {return}

    let copy_value = get_value(copy_element)

    crud_table.addEventListener('mousemove', (event)=>{
        let hovered_element = document.elementFromPoint(event.clientX, event.clientY)

        let is_editor = ()=>{ return hovered_element.tagName === 'INPUT' || hovered_element.tagName === 'SELECT' }

        if (is_editor() && event.which === 3 && hovered_element.tagName === copy_element.tagName) {
            if (copy_element.type !== hovered_element.type) {return}
            hovered_element.value = copy_value
        }
    })
}


crud_table.addEventListener('mousedown', (event)=>{
    if (event.which === 3) {copy_input_value_by_hold(event)}
    suppress_context_menu_once()
})

