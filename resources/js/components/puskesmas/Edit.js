import React, { useEffect } from 'react';
import ReactDOM from 'react-dom';
import { useState } from 'react';
import axios from 'axios';


function Edit(props) {

    const [servicesubunits, setServicesubunits] = useState([])
    const [employes, setEmployes] = useState([])
    const [diags, setDiags] = useState([])
    const [tanggalkunjungan, setTanggalkunjungan] = useState('')
    const [pasien, setPasien] = useState('')
    const [servicesubunitId, setServicesubunitId] = useState('')
    const [employeId, setEmployeId] = useState('')
    const [diagId, setDiagId] = useState('')
    const [catatan, setCatatan] = useState('')
    const [errors, setErrors] = useState([])

    const request = {
        'tanggalkunjungan' : tanggalkunjungan,
        'pasien' : pasien,
        'servicesubunit' : servicesubunitId,
        'employe' : employeId,
        'diag' : diagId,
        'catatan' : catatan
    }

    const ubahRecord = async(e) =>{
        e.preventDefault()
        try{
            let response = await axios.put(props.endpoint, request)
            window.location.href = `/puskesmas/kunjungan/${response.data.tahun}/${response.data.bulan}`
        }catch(e){
            console.log(e.message)
            setErrors(e.response.data.errors)
        }
    }

    const getDiagnosa = async() => {
        try{
            let response = await axios.get('/puskesmas/diagnosa')
            setDiags(response.data.diagnosa)
        }catch(e){
            console.log(e.message)
        }
    }

    const getDokter = async(e) => {
        setServicesubunitId(e.target.value)
        try{
            let response = await axios.get(`/puskesmas/nakes/${e.target.value}`)
            setEmployes(response.data.dokter)
            // console.log(response.data.dokter)
        }catch(e){
            console.log(e.message)
        }
    }

    const getPoli = async() => {
        try{
            let response = await axios.get('/puskesmas/poli')
            setServicesubunits(response.data.poli)
        }catch(e){
            console.log(e.message)
        }
    }

    const getRecord = async(e) => {
        try{
            let response = await axios.get(props.endpoint)
            console.log(response.data.record)
            setTanggalkunjungan(response.data.record.tanggalkunjungan)
            setPasien(response.data.record.pasien)
            setServicesubunitId(response.data.record.servicesubunit_id)
            setEmployeId(response.data.record.employe_id)
            setDiagId(response.data.record.diag_id)
            response.data.record.catatan ? setCatatan(response.data.record.catatan) : setCatatan()

            let allnakes = await axios.get(`/puskesmas/nakes/${response.data.record.servicesubunit_id}`)
            setEmployes(allnakes.data.dokter)
        }catch(e){

        }
    }

    useEffect(()=> {
        getRecord()
        getPoli()
        getDiagnosa()
    }, [])

    return (
        <div className="container">
            <form onSubmit={ubahRecord}>
            <div className="row">
                <div className="col-lg-6">
                    <div className="form-group">
                        <label htmlFor="tanggalkunjungan">Tanggal Kunjungan edit</label>
                        <input value={tanggalkunjungan} onChange={(e)=>setTanggalkunjungan(e.target.value)} type="date" className="form-control" id="tanggalkunjungan" name="tanggalkunjungan" placeholder="--tanggal kunjungan--"/>
                        { errors.tanggalkunjungan ? <div className="text-danger mt-2">tanggal kunjungan harus diisi</div> : '' }
                    </div>
                    <div className="form-group">
                        <label>Pasien</label>
                        <div className="form-check">
                            {
                                pasien == 'Baru' ?
                                <input onChange={(e)=>setPasien(e.target.value)} className="form-check-input" type="radio" name="pasien" id="Baru" value="Baru" checked/>
                                :
                                <input onChange={(e)=>setPasien(e.target.value)} className="form-check-input" type="radio" name="pasien" id="Baru" value="Baru"/>

                            }
                            <label className="form-check-label" htmlFor="Baru">Baru</label>
                        </div>
                        <div className="form-check">
                            {
                                pasien == 'Lama' ?
                                <input onChange={(e)=>setPasien(e.target.value)} className="form-check-input" type="radio" name="pasien" id="Lama" value="Lama" checked/>
                                :
                                <input onChange={(e)=>setPasien(e.target.value)} className="form-check-input" type="radio" name="pasien" id="Lama" value="Lama" />
                            }
                            <label className="form-check-label" htmlFor="Lama">Lama</label>
                        </div>
                        { errors.pasien ? <div className="text-danger mt-2">pasien harus dipilih</div> : '' }
                    </div>
                    <div className="form-group">
                      <label htmlFor="servicesubunit_id">Poli Pelayanan</label>
                      <select onChange={getDokter} value={servicesubunitId} className="form-control" id="servicesubunit_id" name="servicesubunit_id">
                        <option value="">--poli pelayanan--</option>
                        {
                            servicesubunits.map((poli,index)=>{
                                return (
                                        <option key={index} value={poli.id}>{poli.poli}</option>                                  
                                )}
                            )
                        }
                      </select>
                      { errors.servicesubunit ? <div className="text-danger mt-2">poli harus dipilih</div> : '' }
                    </div>
                    <div className="form-group">
                      <label htmlFor="employe_id">Dokter/Dokter Gigi/Bidan</label>
                      <select value={employeId} onChange={(e)=>setEmployeId(e.target.value)} className="form-control" id="employe_id" name="employe_id">
                        {
                            employes.map((employe,index)=>{
                                return (
                                    <option key={index} value={employe.employe_id}>{employe.nama}</option>                                       
                                )}
                            )
                        }
                      </select>
                      { errors.employe ? <div className="text-danger mt-2">dokter/bidan harus dipilih</div> : '' }
                    </div>
                </div>
                <div className="col-lg-6">
                    <div className="form-group">
                        <label>Diagnosa</label>
                        <select value={diagId} onChange={(e)=>setDiagId(e.target.value)} className="form-control" name="diag_id">
                            <option>--pilih diagnosa--</option>
                            {
                                diags.map((diagnosa,index)=>{
                                    return (
                                            <option key={index} value={diagnosa.id}>{diagnosa.kode} - {diagnosa.diagnosa}</option>                                  
                                    )}
                                )
                            }
                        </select>
                      { errors.diag ? <div className="text-danger mt-2">diagnosa harus dipilih</div> : '' }
                    </div>
                    <div className="form-group">
                        <label htmlFor="catatan">Catatan</label>
                        <textarea value={catatan} onChange={(e) => setCatatan(e.target.value)} className="form-control" type="text" name="catatan" id="catatan" rows="5"></textarea>
                      { errors.catatan ? <div className="text-danger mt-2">catatan harus dipilih</div> : '' }
                    </div>
                </div>
            </div>
            <button type="submit" className="btn btn-block btn-warning">SIMPAN</button>
            </form>
        </div>
    );
}

export default Edit;

if (document.getElementById('editRecord')) {
    var item = document.getElementById('editRecord')
    ReactDOM.render(<Edit endpoint={item.getAttribute('endpoint')}/>, document.getElementById('editRecord'));
}
