'use client'
import Image from "next/image";
import styles from "./page.module.css";
import { Box, Button, Grid, List, ListItemButton, ListItemIcon, ListItemText, Modal, Paper, Table, TextField, Typography } from "@mui/material";
import { DataGrid, GridColDef } from '@mui/x-data-grid';
import { useEffect, useState } from "react";
import InboxIcon from '@mui/icons-material/Inbox';
import DraftsIcon from '@mui/icons-material/Drafts';
import EditIcon from '@mui/icons-material/Edit';
import Divider from '@mui/material/Divider';
import DeleteIcon from '@mui/icons-material/Delete';
import AssignmentIcon from '@mui/icons-material/Assignment';
import CheckIcon from '@mui/icons-material/Check';
import { Add, HdrPlusOutlined, PlusOne } from "@mui/icons-material";


const paginationModel = { page: 0, pageSize: 5 };
const style = {
  position: 'absolute',
  top: '50%',
  left: '50%',
  transform: 'translate(-50%, -50%)',
  width: 400,
  bgcolor: 'background.paper',
  border: '2px solid #000',
  boxShadow: 24,
  p: 4,
};

export default function Home() {
  const [metas, setmetas] = useState([]);
  const [meta, setMeta] = useState('');
  const [tasks, setTasks] = useState([]);
  const [selectedIndex, setSelectedIndex] = useState(1);
  const [open, setOpen] = useState(false);
  const handleOpen = () => setOpen(true);
  const handleClose = () => setOpen(false);
  const handleChange = (event) => {
    setMeta(event.target.value); // Actualiza el estado con el valor del TextField
  };

  const rows = tasks.map(task => ({
    id: task.TaskID,
    TaskDetails: task.TaskDetails,
    CreatedAt: task.CreatedAt,
    Task_StatusID: task.status.StatusDetails,
  }));

  const columns = [
    { field: 'id', headerName: 'ID', width: 100 },
    { field: 'TaskDetails', headerName: 'Details', width: 250 },
    { field: 'CreatedAt', headerName: 'Created At', width: 200 },
    { field: 'Task_StatusID', headerName: 'Status ID', width: 150 },
  ];


  useEffect(() => {
    getMetas()
  }, [])

  useEffect(() => {
    getTasks()
  }, [selectedIndex])


  const handleListItemClick = (event, index) => {
    setSelectedIndex(index);
    console.log(index)
    console.log(tasks)
  };

  const handleDeleteClick = (event, index) => {
    //setSelectedIndex(index);
    console.log('delete');
  };

  const getMetas = async () => {
    const options = { method: 'GET' };

    fetch('http://localhost:8000/api/metas', options)
      .then(response => response.json())
      .then(response => setmetas(response.metas))
      .catch(err => console.error(err));

  }

  const getTasks = async (metaID) => {
    const options = { method: 'GET' };

    fetch(`http://localhost:8000/api/tasks?metaID=${selectedIndex}`, options)
      .then(response => response.json())
      .then(response => setTasks(response.tasks))
      .catch(err => console.error(err));
  };

  const postMetas = async () => {
    const options = { method: 'POST', body: `{"MetaDetails":${meta}}`};

    fetch('http://localhost:8000/api/metas', options)
      .then(response => response.json())
      .then(response => console.log(response))
      .catch(err => console.error(err));

  }

  const deleteMetas = async () => {

  }

  const updateMeta = async () => {

  }

  return (
    <Grid container spacing={6}>
      <Grid item xs={12}>
        <Typography style={{ fontSize: 40, textAlign: 'center' }}>Control de Metas</Typography>
      </Grid>
      <Grid item xs={4} sx={{ marginLeft: 2 }}>
        <Button size="large" variant="outlined" onClick={handleOpen}>Nueva Meta</Button>
        <Modal
          open={open}
          onClose={handleClose}
          aria-labelledby="modal-modal-title"
          aria-describedby="modal-modal-description"
        >
          <Box sx={style}>
            <TextField fullWidth id="outlined-basic" label="Nueva Meta" variant="outlined"
              value={meta} // Vincula el valor al estado
              onChange={handleChange} // Maneja cambios en el campo de texto
            />
            <Grid sx={{ padding: 1, gap: 3, display: 'flex' }}>
              <Button size="large" variant="contained" onClick={event => postMetas(event)}>Agregar</Button>
              <Button color="inherit" size="large" variant="contained" onClick={handleClose}>Cancelar</Button>
            </Grid>
          </Box>
        </Modal>
        <Box sx={{ width: '100%', maxWidth: 360, bgcolor: 'background.paper' }}>
          <List component="nav" aria-label="main mailbox folders">
            <Divider />
            {metas?.map((data, index) => (
              <Box key={data.MetaID}>

                <ListItemButton key={index}
                  selected={selectedIndex}
                  onClick={(event) => handleListItemClick(event, data.MetaID)}
                >
                  <ListItemIcon>
                    <AssignmentIcon />
                  </ListItemIcon>

                  <ListItemText primary={data.MetaDetails} secondary={data.CreatedAt} />
                  <Box onClick={(event) => handleDeleteClick(event)}><EditIcon color="info" /></Box>
                  <Box onClick={(event) => handleDeleteClick(event)}><DeleteIcon color="error" /></Box>
                </ListItemButton>
                <Divider />
              </Box>
            ))
            }

          </List>
        </Box>
      </Grid>
      <Grid item xs={7}>
        <Grid item xs={12} sx={{ padding: 1, gap: 3, display: 'flex' }}>
          <Button variant="outlined"><Add />Agregar Tarea</Button>
          <Button variant="outlined"><CheckIcon /> Completar Tarea</Button>
          <Button variant="outlined"><EditIcon />Editar</Button>
          <Button variant="outlined"><DeleteIcon />Eliminar</Button>
        </Grid>
        <Paper sx={{ height: 400, width: '100%' }}>
          <DataGrid
            rows={rows}
            columns={columns}
            initialState={{ pagination: { paginationModel } }}
            pageSizeOptions={[5, 10]}
            checkboxSelection
            sx={{ border: 0 }}
          />
        </Paper>
      </Grid>
    </Grid>
  );
}
