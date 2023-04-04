
function TodoRowItem(props){

    const name="eric"

return(
    <tr onClick={ () => props.deleteTodo(props.rownNumber)}>
                
    <td scope='row'>{props.rownNumber}</td>
      <td>{props.rowDescription}</td>
      <td>{name}</td>
    </tr>
)
}

export default TodoRowItem;