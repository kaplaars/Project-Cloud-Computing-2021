using System.ServiceModel;
namespace Models
{
    [ServiceContract]
    public interface Isoapapi
    {
        [OperationContract]
        string Test(string s);
    }
}
