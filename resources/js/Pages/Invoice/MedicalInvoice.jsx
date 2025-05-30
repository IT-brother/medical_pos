
import React, { useState } from 'react';
import { Inertia } from '@inertiajs/inertia'; 
import { Link, usePage } from "@inertiajs/inertia-react";
import Swal from 'sweetalert2';
import Select from 'react-select';
function MedicalInvoice({services}) {
  const [address,setAddress] = useState('');
  const [patient,setPatient] = useState('');
  const [discount,setDiscount] = useState(0);
  const [payment,setPayment] = useState("Cash");
  const [foc,setFoc] = useState(0);
  const [loading,setLoading] = useState(false);
  const { errors, flash } = usePage().props;
  const [items, setItems] = useState([
     { name: '', quantity: 1, price: '' }
  ],
);

  const handleItemChange = (index, field, value) => {
    const newItems = [...items];
    newItems[index][field] = field === 'name' ? value : parseFloat(value);
    setItems(newItems);
  };

  const handleAddItem = () => {
    setItems([...items, { name: '', quantity: 1, price: '' }]);
  };

  const handleRemoveItem = (index) => {
    const newItems = items.filter((_, i) => i !== index);
    setItems(newItems);
  };

  const getItemTotal = (item) => item.quantity * item.price;

  const getSubtotal = () => {
    return items.reduce((sum, item) => sum + getItemTotal(item), 0);
  };
  const getDiscountFoc = (discount,foc) => {
    return  parseInt(discount) + parseInt(foc);
  }
  const submitInvoice = (e) => {
    e.preventDefault();
    setLoading(true);
    Inertia.post('/medical-invoice', {items,patient,address,foc,discount,payment},{
        preserveScroll: true,
        onSuccess: () => {
            setLoading(false);
            console.log(
              "Success voucher"
            );
            Swal.fire({
                    title: "<span style='color:#000'>အောင်မြင်ပါသည်...</span>",
                   // icon: "success"
                  });
            setItems([{ name: '', quantity: 1, price: '' }]);
            setPatient('');
            setAddress('');
            window.location.href = "/admin/medical-orders";
        },
        onError: (error) => {
            let message = 'An error occurred.';
            if (error.status) {
                message = error.status
            }
            setLoading(false);
        }
    });
  }
const handleChange = (selectedOption,index) => {
    const newItems = [...items];
    newItems[index]["name"]= selectedOption.value;
    setItems(newItems);
  };
  const customStyles = {
  control: (provided) => ({
    ...provided,
    padding: '6px', // 👈 padding around the control (the main input)
    minHeight: '30px',
    border:'1px solid #000'
  }),
  option: (provided, state) => ({
    ...provided,
    padding: '5px 15px', // 👈 padding for each option
  }),
  valueContainer: (provided) => ({
    ...provided,
    padding: '0 8px', // 👈 padding inside the input container
  }),
};
  return (
    <div className='w-3/4 mx-auto bg-gray-200 p-4 mt-3 text-whit max-h-full'>
      <div className='grid grid-cols-3 gap-4'>
          <div className='w-full'>
            <label>Patient Name: <b className='text-red-500'>*</b></label>
            <input
              type="text"
              value={patient}
              onChange={(e) => setPatient(e.target.value)}
              className='p-2 border-0 border-b-1 outline-0'
            />
            {
                errors.patient && <div className="text-red-500 text-sm">{errors.patient}</div>
            }
          </div>
          <div>
            <label>Patient address: <b className='text-red-500'>*</b></label>
            <input
              type="text"
              value={address}
              onChange={(e) => setAddress(e.target.value)}
              className='p-2 border-0 border-b-1 outline-0'
            />
            {
                errors.address && <div className="text-red-500 text-sm">{errors.address}</div>
            }
        </div> 
          <div>
            <label>Payment: <b className='text-red-500'>*</b></label>
            <select
              onChange={(e) => setPayment(e.target.value)}
              className='p-2 border-0 border-b-1 outline-0 w-50'
            >
              <option value={"Cash"}>Cash</option>
              <option value={"Pay"}>Pay</option>
            </select>
            {
                errors.address && <div className="text-red-500 text-sm">{errors.address}</div>
            }
        </div>
      </div><br/>
      <table className='p-2 w-full'>
          <thead>
            <tr className=' bg-cyan-600'>
              <th className='p-2'>Name</th>
              <th>Qty</th>
              <th>Price</th>
              <th>Total</th>
              <th><button onClick={handleAddItem} style={{ cursor:"pointer" }}>+ Add </button></th>
            </tr>
          </thead>
          <tbody>
            {items.map((item, index) => (
              <tr key={index}>
                <td className='p-1 w-1/2'>
                  <Select
                    options={services}
                    isSearchable
                    styles={customStyles}
                    onChange={(selected) => handleChange(selected,index)}
                    className={`py-2 px-2 w-full ${
                      errors[`items.${index}.name`]  ? 'border-red-500' : ''
                    }`} 
                  />
                </td>
                <td className='p-1 w-1/7'>
                  <input
                    type="number"
                    min="1"
                    value={item.quantity}
                    onChange={(e) => handleItemChange(index, 'quantity', e.target.value)}
                    className={`border p-2 w-full bg-white ${
                      errors[`items.${index}.quantity`]  ? 'border-red-500' : 'border-1'
                    }`}
                  />
                </td>
                <td className='p-1 w-1/7'>
                    <input
                    type="number"
                    value={item.price}
                    onChange={(e) => handleItemChange(index, 'price', e.target.value)}
                     className={`border p-2 w-full bg-white ${
                      errors[`items.${index}.price`]  ? 'border-red-500' : 'border-1'
                    }`} 
                  />
                </td>
                <td className='p-1 w-1/7' style={{ textAlign:'right' }}>
                  <span className='p-2  w-full'> {getItemTotal(item).toFixed(2)}</span>
                </td>
                <td style={{ width:"100px", textAlign:'center'}}>
                  {items.length > 1 && (
                    <svg className='text-red-500 size-6' onClick={() => handleRemoveItem(index)}  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor">
                      <path className='text-red-500' strokeLinecap="round" strokeLinejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                    </svg>
                  )}
                </td>
              </tr>
            ))}
            <tr>
              <td colSpan={3} className="font-bold font-black" style={{ textAlign:"right",paddingRight:"20px" }}>Total</td>
              <td colSpan={1} className='p-1 float-right'>{getSubtotal().toFixed(2)} </td>
            </tr>
            <tr>
              <td colSpan={3} className="font-bold font-black" style={{ textAlign:"right",paddingRight:"20px" }}>Discount</td>
              <td className='p-1'>
                <input 
                  type="number"
                  min="1"
                  className='p-1 border-1 w-full bg-white'
                  onChange={(e) => setDiscount(e.target.value)}
                />
              </td>
            </tr>
            <tr>
              <td colSpan={3} className="font-bold font-black" style={{ textAlign:"right",paddingRight:"20px" }}>FOC</td>
              <td className='p-1'>
                <input 
                  type="number"
                  min="1"
                  className='p-1 border-1 w-full bg-white'
                  onChange={(e) => setFoc(e.target.value)}
                />
              </td>
            </tr>
            <tr>
              <td colSpan={3} className="font-bold font-black" style={{ textAlign:"right",paddingRight:"20px" }}>Total Amount</td>
              <td className='p-1'>{getSubtotal() - getDiscountFoc(discount,foc)}</td>
            </tr>
          </tbody>
      </table>
      <div className='w-full text-center gap-2' >
          <a href='/admin/medical-orders' className='px-4  py-2 bg-sky-400 hover:bg-sky-500 mr-3 rounded'>Back</a>
          <button type='button' onClick={submitInvoice} className='bg-green-600 mx-auto hover:bg-green-700 text-white mr-2 font-semibold py-2 px-4 rounded'
         > {loading? "Loading...":"Save"} </button>

      </div>
    </div>
  );
}

export default MedicalInvoice;
