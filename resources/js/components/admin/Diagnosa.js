import React, { useEffect } from 'react';
import ReactDOM from 'react-dom';
import { useState } from 'react';

function Diagnosa(props) {

    const [diags, setDiags] = useState([])
    const [diagnosa, setDiagnosa] = useState('')

    const getAllDiagnosa = async () =>{
        try{
            let response = await axios.get(`/admin/diagnosa`)
            setDiags(response.data.diagnosa)
        }catch(e){
            console.log(e.message)
        }
    }
    
    const getDiagnosa = async () =>{
        try{
            let response = await axios.get(`/admin/diagnosa/${diagnosa}`)
            setDiags(response.data.diagnosa)
        }catch(e){
            console.log(e.message)
        }
    }

    useEffect(()=> {
        getDiagnosa()
    }, [diagnosa])

    return (
        <div className="container">
            <div className="row">
                <div className="col-lg-12">
                    <div className="form-group">
                        <label htmlFor="diagnosa">Cari Diagnosa</label>
                        <input value={diagnosa} onChange={(e)=>setDiagnosa(e.target.value)} type="text" className="form-control" id="diagnosa" name="diagnosa" placeholder="--diagnosa--" autoComplete="off"/>
                    </div>
                </div>
            </div>
            <div className="row">
                <div className="col-lg-12">
                    <table className="table table-bordered table-hover text-wrap">
                        <tbody>
                            <tr>
                                <th className="text-center" scope="col" >Kode</th>
                                <th className="text-center" scope="col" >Diagnosa</th>
                            </tr>
                        </tbody>
                        {
                            diags.map((diagnosa,index)=>{
                                return (
                                    <tbody key={index}>
                                        <tr>
                                            <td scope="col">{diagnosa.kode}</td>
                                            <td scope="col">{diagnosa.diagnosa}</td>
                                        </tr>
                                    </tbody>                                  
                                )}
                            )
                        }
                    </table>
                </div>
            </div>        
        </div>
    );
}

export default Diagnosa;

if (document.getElementById('daftarDiagnosa')) {
    var item = document.getElementById('daftarDiagnosa')
    ReactDOM.render(<Diagnosa/>, document.getElementById('daftarDiagnosa'));
}
