import TodoRowItem from "./TodoRowItems";

function Todotable(props){
    return(
        <table className="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">description</th>
                    <th scope="col">Assigned</th>

                </tr>
            </thead>
            <tbody>
            {/* <TodoRowItem
           rownNumber={props.todos[0].rownNumber} 
           rowDescription={props.todos[0].rowDescription}
           /> */}
           {
           props.todos.map( todo => (
            <TodoRowItem
            key = {todo.rownNumber}
            rownNumber={todo.rownNumber}
            rowDescription={todo.rowDescription}
            deleteTodo = {props.deleteTodo}
            />

           ))
           }
            </tbody>

        </table>
    )

}
export default Todotable;