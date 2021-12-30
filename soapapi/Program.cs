using SoapCore;
using Models;

var builder = WebApplication.CreateBuilder(args);

builder.Services.AddSingleton<Isoapapi, Dienst>();

var app = builder.Build();
app.UseSoapEndpoint<Isoapapi>("/soapapi.asmx", new SoapEncoderOptions());
app.MapGet("/", () => "Hello World!");

app.Run();
