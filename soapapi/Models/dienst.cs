namespace Models {
    public class Dienst : Isoapapi
    {
        public string Test(string s)
        {
            Console.WriteLine("Test Method Executed!");
            return "testtekst";
        }
    }
}