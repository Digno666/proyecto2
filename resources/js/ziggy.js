const Ziggy = {"url":"http:\/\/localhost","port":null,"defaults":{},"routes":{"login":{"uri":"login","methods":["POST"]},"logout":{"uri":"logout","methods":["POST"]},"password.request":{"uri":"forgot-password","methods":["GET","HEAD"]},"password.reset":{"uri":"reset-password\/{token}","methods":["GET","HEAD"],"parameters":["token"]},"password.email":{"uri":"forgot-password","methods":["POST"]},"password.update":{"uri":"reset-password","methods":["POST"]},"register":{"uri":"register","methods":["GET","HEAD"]},"register.store":{"uri":"register","methods":["POST"]},"user-profile-information.update":{"uri":"user\/profile-information","methods":["PUT"]},"user-password.update":{"uri":"user\/password","methods":["PUT"]},"password.confirm":{"uri":"user\/confirm-password","methods":["GET","HEAD"]},"password.confirmation":{"uri":"user\/confirmed-password-status","methods":["GET","HEAD"]},"password.confirm.store":{"uri":"user\/confirm-password","methods":["POST"]},"two-factor.login":{"uri":"two-factor-challenge","methods":["GET","HEAD"]},"two-factor.login.store":{"uri":"two-factor-challenge","methods":["POST"]},"two-factor.enable":{"uri":"user\/two-factor-authentication","methods":["POST"]},"two-factor.confirm":{"uri":"user\/confirmed-two-factor-authentication","methods":["POST"]},"two-factor.disable":{"uri":"user\/two-factor-authentication","methods":["DELETE"]},"two-factor.qr-code":{"uri":"user\/two-factor-qr-code","methods":["GET","HEAD"]},"two-factor.secret-key":{"uri":"user\/two-factor-secret-key","methods":["GET","HEAD"]},"two-factor.recovery-codes":{"uri":"user\/two-factor-recovery-codes","methods":["GET","HEAD"]},"profile.show":{"uri":"user\/profile","methods":["GET","HEAD"]},"other-browser-sessions.destroy":{"uri":"user\/other-browser-sessions","methods":["DELETE"]},"current-user-photo.destroy":{"uri":"user\/profile-photo","methods":["DELETE"]},"current-user.destroy":{"uri":"user","methods":["DELETE"]},"sanctum.csrf-cookie":{"uri":"sanctum\/csrf-cookie","methods":["GET","HEAD"]},"dashboard":{"uri":"dashboard","methods":["GET","HEAD"]},"api.visitas":{"uri":"api\/visitas","methods":["GET","HEAD"]},"vista-cliente":{"uri":"vista-cliente","methods":["GET","HEAD"]},"mostrar.membresias":{"uri":"membresias","methods":["GET","HEAD"]},"detalle-compra":{"uri":"detalle-compra","methods":["GET","HEAD"]},"venta.index":{"uri":"venta\/index","methods":["GET","HEAD"]},"venta.getProductos":{"uri":"api\/categorias\/{codCategoria}\/productos","methods":["GET","HEAD"],"parameters":["codCategoria"]},"venta.obtenerProductos":
{"uri":"api\/venta\/productos","methods":["GET","HEAD"]},"comprar.detalle":{"uri":"comprar\/{idsYCantidades}","methods":["GET","HEAD"],"parameters":["idsYCantidades"]},"search":{"uri":"search","methods":["GET","HEAD"]},"reportes.ventas":{"uri":"reportes\/ventas","methods":["GET","HEAD"]},"reportes.compras":{"uri":"reportes\/compras","methods":["GET","HEAD"]},"tipoUsuario.index":{"uri":"tipoUsuario\/index","methods":["GET","HEAD"]},"tipoUsuario.create":{"uri":"tipoUsuario\/create","methods":["GET","HEAD"]},"tipoUsuario.store":{"uri":"tipoUsuario\/store","methods":["POST"]},"tipoUsuario.edit":{"uri":"tipoUsuario\/edit\/{codTipoUsuario}","methods":["GET","HEAD"],"parameters":["codTipoUsuario"]},"tipoUsuario.update":{"uri":"tipoUsuario\/update\/{codTipoUsuario}","methods":["PUT"],"parameters":["codTipoUsuario"]},"tipoUsuario.destroy":{"uri":"tipoUsuario\/eliminar\/{codTipoUsuario}","methods":["DELETE"],"parameters":["codTipoUsuario"]},"tipoUsuario.buscar":{"uri":"tipoUsuario\/buscar","methods":["GET","HEAD"]},"usuario.index":{"uri":"usuario\/index","methods":["GET","HEAD"]},"usuario.create":{"uri":"usuario\/create","methods":["GET","HEAD"]},"usuario.store":{"uri":"usuario\/store","methods":["POST"]},"usuario.edit":{"uri":"usuario\/edit\/{codUsuario}","methods":["GET","HEAD"],"parameters":["codUsuario"]},"usuario.update":{"uri":"usuario\/update\/{codUsuario}","methods":["PUT"],"parameters":["codUsuario"]},"usuario.destroy":{"uri":"usuario\/eliminar\/{codUsuario}","methods":["DELETE"],"parameters":["codUsuario"]},"usuario.buscar":{"uri":"usuario\/buscar","methods":["GET","HEAD"]},"email-ya-existe":{"uri":"usuario\/email-ya-existe","methods":["POST"]},"cliente.index":{"uri":"cliente\/index","methods":["GET","HEAD"]},"cliente.create":{"uri":"cliente\/create","methods":["GET","HEAD"]},"cliente.store":{"uri":"cliente\/store","methods":["POST"]},"cliente.edit":{"uri":"cliente\/edit\/{carnetIdentidad}","methods":["GET","HEAD"],"parameters":["carnetIdentidad"]},"cliente.update":{"uri":"cliente\/update\/{carnetIdentidad}","methods":["PUT"],"parameters":["carnetIdentidad"]},"cliente.destroy":{"uri":"cliente\/eliminar\/{carnetIdentidad}","methods":["DELETE"],"parameters":["carnetIdentidad"]},"ci-ya-existe":{"uri":"cliente\/ci-ya-existe","methods":["POST"]},"clientes.buscar":{"uri":"clientes\/buscar","methods":["GET","HEAD"]},"cliente.seleccion":{"uri":"cliente\/seleccionCliente\/{carnetIdentidad}","methods":["GET","HEAD"],"parameters":["carnetIdentidad"]},"permisos":{"uri":"permisos","methods":["GET","HEAD"]},"encargado.index":{"uri":"encargado\/index","methods":["GET","HEAD"]},"encargado.create":{"uri":"encargado\/create","methods":["GET","HEAD"]},"encargado.store":{"uri":"encargado\/store","methods":["POST"]},"encargado.edit":{"uri":"encargado\/edit\/{carnetIdentidad}","methods":["GET","HEAD"],"parameters":["carnetIdentidad"]},"encargado.update":{"uri":"encargado\/update\/{carnetIdentidad}","methods":["PUT"],"parameters":["carnetIdentidad"]},"vendedor.destroy":{"uri":"encargado\/eliminar\/{carnetIdentidad}","methods":["DELETE"],"parameters":["carnetIdentidad"]},"ci-ya-existes":{"uri":"encargado\/ci-ya-existe","methods":["POST"]},"categoria.index":{"uri":"categoria\/index","methods":["GET","HEAD"]},"categoria.index2":{"uri":"categoria\/index2","methods":["GET","HEAD"]},"categoria.create":{"uri":"categoria\/create","methods":["GET","HEAD"]},"categoria.store":{"uri":"categoria\/store","methods":["POST"]},"categoria.edit":{"uri":"categoria\/edit\/{codCategoria}","methods":["GET","HEAD"],"parameters":["codCategoria"]},"categoria.update":{"uri":"categoria\/update\/{codCategoria}","methods":["PUT"],"parameters":["codCategoria"]},"categoria.destroy":{"uri":"categoria\/eliminar\/{categoria}","methods":["DELETE"],"parameters":["categoria"],"bindings":{"categoria":"codCategoria"}},"proveedor.index":{"uri":"proveedor\/index","methods":["GET","HEAD"]},"proveedor.create":{"uri":"proveedor\/create","methods":["GET","HEAD"]},"proveedor.store":{"uri":"proveedor\/store","methods":["POST"]},"proveedor.edit":{"uri":"proveedor\/edit\/{codProveedor}","methods":["GET","HEAD"],"parameters":["codProveedor"]},"proveedor.update":{"uri":"proveedor\/update\/{codProveedor}","methods":["PUT"],"parameters":["codProveedor"]},"proveedor.destroy":{"uri":"proveedor\/eliminar\/{codProveedor}","methods":["DELETE"],"parameters":["codProveedor"]},"producto.index":{"uri":"producto\/index","methods":["GET","HEAD"]},"producto.create":{"uri":"producto\/create","methods":["GET","HEAD"]},"producto.store":{"uri":"producto\/store","methods":["POST"]},"producto.edit":{"uri":"producto\/edit\/{codProducto}","methods":["GET","HEAD"],"parameters":["codProducto"]},"producto.update":{"uri":"producto\/update\/{codProducto}","methods":["PUT"],"parameters":["codProducto"]},"producto.destroy":{"uri":"producto\/eliminar\/{codProducto}","methods":["DELETE"],"parameters":["codProducto"]},"producto.buscar":{"uri":"producto\/buscar","methods":["GET","HEAD"]},"horario.index":{"uri":"horario\/index","methods":["GET","HEAD"]},"horario.create":{"uri":"horario\/create","methods":["GET","HEAD"]},"horario.store":{"uri":"horario\/store","methods":["POST"]},"horario.edit":{"uri":"horario\/edit\/{codHorario}","methods":["GET","HEAD"],"parameters":["codHorario"]},"horario.update":{"uri":"horario\/update\/{codHorario}","methods":["PUT"],"parameters":["codHorario"]},"horario.destroy":{"uri":"horario\/eliminar\/{codHorario}","methods":["DELETE"],"parameters":["codHorario"]},"servicio.index":{"uri":"servicio\/index","methods":["GET","HEAD"]},"servicio.create":{"uri":"servicio\/create","methods":["GET","HEAD"]},"servicio.store":{"uri":"servicio\/store","methods":["POST"]},"servicio.edit":{"uri":"servicio\/edit\/{codServicio}","methods":["GET","HEAD"],"parameters":["codServicio"]},"servicio.update":{"uri":"servicio\/update\/{codServicio}","methods":["PUT"],"parameters":["codServicio"]},"servicio.destroy":{"uri":"servicio\/eliminar\/{codServicio}","methods":["DELETE"],"parameters":["codServicio"]},"precioServicio.index":{"uri":"precioServicio\/index","methods":["GET","HEAD"]},"precioServicio.create":{"uri":"precioServicio\/create","methods":["GET","HEAD"]},"precioServicio.store":{"uri":"precioServicio\/store","methods":["POST"]},"precioServicio.edit":{"uri":"precioServicio\/edit\/{codPrecioServicio}","methods":["GET","HEAD"],"parameters":["codPrecioServicio"]},"precioServicio.update":{"uri":"precioServicio\/update\/{codPrecioServicio}","methods":["PUT"],"parameters":["codPrecioServicio"]},"precioServicio.destroy":{"uri":"precioServicio\/eliminar\/{codPrecioServicio}","methods":["DELETE"],"parameters":["codPrecioServicio"]},"compra.index":{"uri":"compra\/index","methods":["GET","HEAD"]},"compra.create":{"uri":"compra\/create","methods":["GET","HEAD"]},"compra.store":{"uri":"compra\/store","methods":["POST"]},"compra.show":{"uri":"compra\/{codCompra}","methods":["GET","HEAD"],"parameters":["codCompra"]},"compra.edit":{"uri":"compra\/edit\/{codCompra}","methods":["GET","HEAD"],"parameters":["codCompra"]},"compra.update":{"uri":"compra\/update\/{codCompra}","methods":["PUT"],"parameters":["codCompra"]},"compra.destroy":{"uri":"compra\/eliminar\/{codCompra}","methods":["DELETE"],"parameters":["codCompra"]},"productos.buscar":{"uri":"compra\/productos\/buscar","methods":["GET","HEAD"]},"membresia.index":{"uri":"membresia\/index","methods":["GET","HEAD"]},"membresia.create":{"uri":"membresia\/create","methods":["GET","HEAD"]},"membresia.store":{"uri":"membresia\/store","methods":["POST"]},"membresia.show":{"uri":"membresia\/show\/{membresia}","methods":["GET","HEAD"],"parameters":["membresia"]},"membresia.destroy":{"uri":"membresia\/destroy\/{membresia}","methods":["DELETE"],"parameters":["membresia"],"bindings":{"membresia":"codMembresia"}},"servicios.buscar":{"uri":"servicios\/buscar","methods":["GET","HEAD"]},"venta.create":{"uri":"venta\/create","methods":["GET","HEAD"]},"venta.show":{"uri":"venta\/{codVenta}","methods":["GET","HEAD"],"parameters":["codVenta"]},"venta.store":{"uri":"venta\/store","methods":["POST"]},"venta.update":{"uri":"venta\/update\/{codVenta}","methods":["PUT"],"parameters":["codVenta"]},"venta.destroy":{"uri":"venta\/destroy\/{codVenta}","methods":["DELETE"],"parameters":["codVenta"]},"encargado":{"uri":"estadisticas","methods":["GET","HEAD"]},"admin":{"uri":"admin","methods":["GET","HEAD"]},"storage.local":{"uri":"storage\/{path}","methods":["GET","HEAD"],"wheres":{"path":".*"},"parameters":["path"]}}};
if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
  Object.assign(Ziggy.routes, window.Ziggy.routes);
}
export { Ziggy };