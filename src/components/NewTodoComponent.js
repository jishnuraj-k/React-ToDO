import React,{useState} from "react"
function NewtodoComponent(props) 
{
    const [description, setDescription] = useState('');
    const [assigned, setassigned] = useState('');
    // const descriptionchange =(event) =>{
    //     setDescription(event.target.value)

    //     console.log(event.target.value)
    // }
    // const Assignedchange =(event) =>{
    //     setassigned(event.target.value)
    //     console.log(event.target.value)
    // }

    const submitTodo =() =>{
        if(description != '') {
            props.addtodo_data(description)
            setDescription('')

        }
    }

    return(
        <div className="mt-5">
            <form>
                {/* <div className="mb-3">
                    <label className="form-label">Assigned</label>
                    <input type="text" className="form-control" onChange={Assignedchange} value={assigned} required></input>

                </div> */}
                <div className="mb-3">
                    <label className="form-label">description</label>
                    <input type="text" className="form-control" onChange={e => setDescription(e.target.value)} value = {description} required></input>

                </div>
<button type="button" className="btn btn-primary mt-3" onClick={submitTodo}>Add Todo</button>
            </form>

        </div>
    )

}
export default NewtodoComponent;