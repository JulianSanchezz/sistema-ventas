<div>
   <H1>SOY EL INICIO</H1>

   <x-card cardTitle='Card Title' cardFooter='card footer'> {{-- pasamos los nombres a las variables de lo que deseamos en el titulo del componente--}}

            <x-slot:cardTools>
                  <a href="#" class="btn btn-primary">crear</a>
            </x-slot:cardTools>
            <x-table>
               <x-slot:thead>
                  <th>thead</th>
                  <th>thead</th>
               </x-slot:thead>
            
                     <tr>
                        <td>...</td>
                        <td>...</td>
                     </tr>            
            </x-table>
   </x-card>
</div>
