                     

                              CATALÀ - ENGLISH - SPAINSH

----------------------------------------------------------
Eina d'Importació i Exportació de Productes per a Printful
----------------------------------------------------------
Aquesta és una eina web senzilla desenvolupada en PHP i JavaScript que permet als usuaris gestionar els seus productes de Printful de manera massiva. L'aplicació es connecta a l'API de Printful per realitzar dues funcions principals: exportar productes existents i importar productes nous a partir d'un fitxer CSV.

✨ Característiques
Connexió Segura: Utilitza una clau API de Printful que s'emmagatzema només durant la sessió.

Pestanya d'Exportació:

Visualitza tots els productes sincronitzats a la teva botiga.

Exporta la llista completa de productes i les seves variants a format CSV.

Exporta la llista de productes a format XML.

Pestanya d'Importació:

Crea nous productes a la teva botiga de Printful massivament pujant un fitxer CSV.

Agrupa automàticament les variants sota el producte corresponent.

⚙️ Requisits
Un servidor web amb suport per a PHP (versió 7.4 o superior recomanada).

Un navegador web modern.

Una clau d'API de Printful amb permisos per llegir i escriure productes.

🚀 Instal·lació i Configuració
Clona o descarrega el repositori:

git clone https://github.com/el-teu-usuari/el-teu-repositori.git

O descarrega el ZIP i descomprimeix-lo al directori del teu servidor web.

Obtén una Clau API de Printful:

Ves al teu panell de control de Printful > Settings > API.

Crea una nova clau d'accés personal.

Assegura't que la clau té permisos per a Products API (lectura i escriptura).

Inicia l'aplicació:

Obre el fitxer index.html al teu navegador a través del teu servidor web (p. ex., http://localhost/exportador-printful/index.html).

📋 Com Utilitzar
Exportar Productes
Introdueix la teva clau API de Printful i fes clic a "Connectar".

L'aplicació carregarà i mostrarà una llista dels teus productes existents.

A la pestanya "Exportar Productes", fes clic a "Descarregar CSV" o "Descarregar XML" per obtenir el fitxer.

Importar Productes
Primer, connecta't amb la teva clau API.

Ves a la pestanya "Importar Productes".

Prepara un fitxer CSV amb les següents columnes obligatòries:

product_name: El nom del producte. L'eina agruparà les variants que tinguin el mateix nom.

variant_id: L'ID numèric de la variant del catàleg de Printful (p. ex., 7670 per a una samarreta Gildan blanca, talla L).

retail_price: El preu de venda que vols establir per a aquesta variant.

print_file_url: L'URL públic del fitxer d'impressió (p. ex., un disseny PNG allotjat a Dropbox, S3, etc.).

thumbnail_url: L'URL públic de la imatge de vista prèvia (mockup) del producte.

Fes clic a "Selecciona un fitxer", tria el teu CSV i prem "Pujar i Importar Productes".

Espera que el procés finalitzi. Rebràs una notificació amb el resultat.

Aquesta eina es proporciona tal qual. Fes proves amb un nombre reduït de productes abans de realitzar importacions massives.


-------------------------------------
Printful Product Import & Export Tool
-------------------------------------
This is a simple web tool developed in PHP and JavaScript that allows users to bulk-manage their Printful products. The application connects to the Printful API to perform two main functions: exporting existing products and importing new products from a CSV file.

✨ Features
Secure Connection: Uses a Printful API key that is stored only for the duration of the session.

Export Tab:

View all synchronized products in your store.

Export the complete list of products and their variants to CSV format.

Export the product list to XML format.

Import Tab:

Create new products in your Printful store in bulk by uploading a CSV file.

Automatically groups variants under the corresponding product.

⚙️ Requirements
A web server with PHP support (version 7.4 or higher recommended).

A modern web browser.

A Printful API key with permissions to read and write products.

🚀 Installation and Setup
Clone or download the repository:

git clone https://github.com/your-username/your-repository.git

Or download the ZIP and unzip it in your web server's directory.

Get a Printful API Key:

Go to your Printful dashboard > Settings > API.

Create a new personal access key.

Ensure the key has permissions for the Products API (read and write).

Launch the application:

Open the index.html file in your browser through your web server (e.g., http://localhost/printful-exporter/index.html).

📋 How to Use
Exporting Products
Enter your Printful API key and click "Connect".

The application will load and display a list of your existing products.

In the "Export Products" tab, click "Download CSV" or "Download XML" to get the file.

Importing Products
First, connect with your API key.

Go to the "Import Products" tab.

Prepare a CSV file with the following required columns:

product_name: The name of the product. The tool will group variants that share the same name.

variant_id: The numeric ID of the variant from the Printful catalog (e.g., 7670 for a white Gildan t-shirt, size L).

retail_price: The selling price you want to set for this variant.

print_file_url: The public URL of the print file (e.g., a PNG design hosted on Dropbox, S3, etc.).

thumbnail_url: The public URL of the product's preview image (mockup).

Click "Select a file", choose your CSV, and press "Upload and Import Products".

Wait for the process to complete. You will receive a notification with the result.

This tool is provided as-is. Please test with a small number of products before performing large bulk imports.

-------------------------------------------------------------------
Herramienta de Importación y Exportación de Productos para Printful
-------------------------------------------------------------------

Esta es una sencilla herramienta web desarrollada en PHP y JavaScript que permite a los usuarios gestionar sus productos de Printful de forma masiva. La aplicación se conecta a la API de Printful para realizar dos funciones principales: exportar productos existentes e importar nuevos productos a partir de un archivo CSV.

✨ Características
Conexión Segura: Utiliza una clave de API de Printful que se almacena únicamente durante la sesión.

Pestaña de Exportación:

Visualiza todos los productos sincronizados en tu tienda.

Exporta la lista completa de productos y sus variantes a formato CSV.

Exporta la lista de productos a formato XML.

Pestaña de Importación:

Crea nuevos productos en tu tienda de Printful de forma masiva subiendo un archivo CSV.

Agrupa automáticamente las variantes bajo el producto correspondiente.

⚙️ Requisitos
Un servidor web con soporte para PHP (versión 7.4 o superior recomendada).

Un navegador web moderno.

Una clave de API de Printful con permisos para leer y escribir productos.

🚀 Instalación y Configuración
Clona o descarga el repositorio:

git clone https://github.com/tu-usuario/tu-repositorio.git

O descarga el ZIP y descomprímelo en el directorio de tu servidor web.

Obtén una Clave de API de Printful:

Ve a tu panel de control de Printful > Ajustes > API.

Crea una nueva clave de acceso personal.

Asegúrate de que la clave tenga permisos para la Products API (lectura y escritura).

Inicia la aplicación:

Abre el archivo index.html en tu navegador a través de tu servidor web (p. ej., http://localhost/exportador-printful/index.html).

📋 Cómo Utilizar
Exportar Productos
Introduce tu clave de API de Printful y haz clic en "Conectar".

La aplicación cargará y mostrará una lista de tus productos existentes.

En la pestaña "Exportar Productos", haz clic en "Descargar CSV" o "Descargar XML" para obtener el archivo.

Importar Productos
Primero, conéctate con tu clave de API.

Ve a la pestaña "Importar Productos".

Prepara un archivo CSV con las siguientes columnas obligatorias:

product_name: El nombre del producto. La herramienta agrupará las variantes que tengan el mismo nombre.

variant_id: El ID numérico de la variante del catálogo de Printful (p. ej., 7670 para una camiseta Gildan blanca, talla L).

retail_price: El precio de venta que deseas establecer para esta variante.

print_file_url: La URL pública del archivo de impresión (p. ej., un diseño PNG alojado en Dropbox, S3, etc.).

thumbnail_url: La URL pública de la imagen de vista previa (mockup) del producto.

Haz clic en "Seleccionar un archivo", elige tu CSV y pulsa "Subir e Importar Productos".

Espera a que el proceso finalice. Recibirás una notificación con el resultado.

Esta herramienta se proporciona tal cual. Realiza pruebas con un número reducido de productos antes de efectuar importaciones masivas.